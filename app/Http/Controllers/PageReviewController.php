<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Mail;

use Carbon\Carbon;

use App\Category;
use App\Region;
use App\Location;
use App\Customer;
use App\Admin;
use App\Review;
use App\News;
use App\Comment;
use App\LikeStatus;

session_start();

class PageReviewController extends Controller
{
    /* Load trang bài viết */
    public function show_review_page($review_slug){
        //Lấy cho header
        $all_category = Category::where('category_status', 1)->orderBy('category_id', 'ASC')->take(5)->get();
        $all_location = Location::where('location_status', 1)->orderBy('location_name', 'ASC')->take(20)->get();

        //Lấy cho footer
        $all_review_bac = DB::table('tbl_review')->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->where('tbl_review.review_status', '=', 1)
        ->where('tbl_region.region_name', '=',"Miền Bắc")
        ->take(4)->get();
        $all_review_nam = DB::table('tbl_review')->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->where('tbl_review.review_status', '=', 1)
        ->where('tbl_region.region_name', '=',"Miền Nam")
        ->take(4)->get();

        // Show bài viết gần đây nhất
        $lastest_review = Review::where('review_status', 1)->orderBy('created_at', 'DESC')->get();

        // Lấy thông tin bài viết
        $review = Review::with('location')->with('category')->with('admin')->where('review_slug', $review_slug)->first();
        $location = Location::with('region')->where('location_id', $review->location_id)->first();
        $region_name = $location->region->region_name;
        $region_slug = $location->region->region_slug;

        //Đếm lượt view
        $review->view_count = $review->view_count + 1;
        $review->save();

        //Lấy bài viết trước đó và bài viết tiếp theo
        $review_prev = Review::where('review_status', 1)->where('review_id', '<', $review->review_id)->orderBy('review_id','DESC')->first();
        if(!$review_prev)
        {
            $review_prev = Review::where('review_status', 1)->orderBy('review_id','DESC')->first();
        }
        $review_next = Review::where('review_status', 1)->where('review_id', '>', $review->review_id)->orderBy('review_id','ASC')->first();
        if(!$review_next)
        {
            $review_next = Review::where('review_status', 1)->orderBy('review_id','ASC')->first();
        }

        return view('pages.review', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 
        'review', 'region_name', 'region_slug', 'review_prev', 'review_next'));
    }
    /* End Load trang bài viết */

    /* Load bình luận của bài viết */
    public function load_comment(Request $request){
        $review_id = $request->review_id;
        $all_comment = Comment::with('customer')->where('comment_status', 1)->where('review_id', $review_id)->orderBy('comment_id','DESC')->get();
        $output = '';
        foreach($all_comment as $key => $comment){
            $output = 
            '<div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="../uploads/CustomerAvatar/'.$comment->customer->customer_avatar.'" height="50px" width="50px">
            <div class="media-body">
                <h6 class="mt-0">'.$comment->customer->customer_last_name.' '.$comment->customer->customer_first_name.'</h6>
                '.$comment->comment_content.'
            </div>
            </div>
            ';
            echo $output;
        }
    }
    /* End Load bình luận của bài viết */

    /* Gửi bình luận của bài viết */
    public function send_comment(Request $request){
        $review_id = $request->review_id;
        $comment_content = $request->comment_content;
        $customer_id = $request->customer_id;

        $review_comment_count = Review::find($review_id);

        if($customer_id ) {
            $comment = new Comment();
            $comment->comment_content= $comment_content;
            $comment->review_id= $review_id;
            $comment->customer_id= $customer_id;
            $comment->comment_status = 1;
            $comment->save();

            $review_comment_count->comment_count = $review_comment_count->comment_count + 1;
            $review_comment_count->save();

        } else {
            echo '<span style="color:red; font-weight: bold;">Hãy đăng nhập trước khi bình luận.</span>';
        }
    }
    /* End Gửi bình luận của bài viết */

    /* Trạng thái like của tài khoản login */
    public function load_like_status(Request $request){
        $review_id = $request->review_id;
        $customer_id = $request->customer_id;

        $review_like_count = Review::find($review_id);

        if(!$customer_id) {
            $output = 
            '<button class="submit btn-like" id="send-like" type="submit">
            <i class="fas fa-thumbs-up" style="color:white"></i>
            <span>&nbsp</span>Like bài viết</button>
            <span style="font-weight:bold; color:blue">Bài viết đã có '.$review_like_count->like_count.' lượt thích.</span>';
        }
        else {
            $like_status = LikeStatus::where('customer_id', $customer_id)->where('review_id', $review_id)->first();
            if(!$like_status) {
                $output = 
                '<button class="submit btn-like" id="send-like" type="submit">
                <i class="fas fa-thumbs-up" style="color:white"></i>
                <span>&nbsp</span>Like bài viết</button>
                <span style="font-weight:bold; color:blue">Bài viết đã có '.$review_like_count->like_count.' lượt thích.</span>';
            }
            else {
                if($like_status->like_status == 1) {
                    $output = 
                    '<button class="submit btn-like" id="send-not-like" type="submit">
                    <i class="fas fa-thumbs-up" style="color:blue"></i>
                    <span>&nbsp</span>Đã like</button>
                    <span style="font-weight:bold; color:blue">Bài viết đã có '.$review_like_count->like_count.' lượt thích.</span>';
                } else {
                    $output = 
                    '<button class="submit btn-like" id="send-like" type="submit">
                    <i class="fas fa-thumbs-up" style="color:white"></i>
                    <span>&nbsp</span>Like bài viết</button>
                    <span style="font-weight:bold; color:blue">Bài viết đã có '.$review_like_count->like_count.' lượt thích.</span>';
                }
            }
        }
        echo $output;
    }
    /* End Trạng thái like của tài khoản login */

    /* Khi không like bài viết */
    public function not_like_review(Request $request){
        $review_id = $request->review_id;
        $customer_id = $request->customer_id;

        $review_like_count = Review::find($review_id);

        if($customer_id) {
            $like = LikeStatus::where('customer_id', $customer_id)->where('review_id', $review_id)->first();
            $like = LikeStatus::find($like->like_id);
            $like->like_status= 0;
            $like->save();
            $review_like_count->like_count = $review_like_count->like_count - 1;
            $review_like_count->save();
        } else {
            echo '<span style="color:red; font-weight: bold;">Hãy đăng nhập trước khi like.</span>';
        }
    }
    /* End Khi không like bài viết */

    /* Khi like bài viết */
    public function like_review(Request $request){
        $review_id = $request->review_id;
        $customer_id = $request->customer_id;

        $review_like_count = Review::find($review_id);

        if($customer_id ) {
            $like = LikeStatus::where('customer_id', $customer_id)->where('review_id', $review_id)->first();
            if($like){
                $like = LikeStatus::find($like->like_id);
                $like->like_status= 1;
                $like->save();
                $review_like_count->like_count = $review_like_count->like_count + 1;
                $review_like_count->save();
            } else {
                $like = new LikeStatus();
                $like->review_id = $review_id;
                $like->customer_id = $customer_id;
                $like->like_status= 1;
                $like->save();
                $review_like_count->like_count = $review_like_count->like_count + 1;
                $review_like_count->save();
            }
        } else {
            echo '<span style="color:red; font-weight: bold;">Hãy đăng nhập trước khi like.</span>';
        }
    }
    /* End Khi like bài viết */
}
