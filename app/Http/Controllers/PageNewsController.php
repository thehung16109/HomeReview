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

class PageNewsController extends Controller
{
    /* Load các tin tức */
    public function show_news() {
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

        // Show tin tức nhiều người quan tâm
        $most_view_news = News::where('news_status', 1)->orderBy('view_count', 'DESC')->get();

        //Show tin tức nổi bật cho slide - tin tức nhiều like nhất
        $news_most_like = News::where('news_status', 1)->orderBy('like_count', 'DESC')->take(5)->get();

        // Show các tin tức
        $all_news = News::where('news_status', 1)->orderBy('news_id', 'DESC')->get();

        return view('pages.category_news', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 
        'most_view_news', 'news_most_like', 'all_news'));
    }
    /* End Load các tin tức */

    /*Load trang tin tức */
    public function show_news_page($news_slug){
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
        $lastest_news = News::where('news_status', 1)->orderBy('created_at', 'DESC')->take(8)->get();

        // Lấy thông tin bài viết
        $news = News::with('admin')->where('news_slug', $news_slug)->first();
        
        //Đếm lượt view
        $news->view_count = $news->view_count + 1;
        $news->save();

        //Lấy bài viết trước đó và bài viết tiếp theo
        $news_prev = News::where('news_status', 1)->where('news_id', '<', $news->news_id)->orderBy('news_id','DESC')->first();
        if(!$news_prev)
        {
            $news_prev = News::where('news_status', 1)->orderBy('news_id','DESC')->first();
        }
        $news_next = News::where('news_status', 1)->where('news_id', '>', $news->news_id)->orderBy('news_id','ASC')->first();
        if(!$news_next)
        {
            $news_next = News::where('news_status', 1)->orderBy('news_id','ASC')->first();
        }

        return view('pages.news', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_news', 
        'news', 'news_prev', 'news_next'));
    }
    /*End load trang tin tức */


    public function load_like_status_news(Request $request){
        $news_id = $request->news_id;
        $customer_id = $request->customer_id;

        $news_like_count = News::find($news_id);

        if(!$customer_id) {
            $output = 
            '<button class="submit btn-like" id="send-like" type="submit">
            <i class="fas fa-thumbs-up" style="color:white"></i>
            <span>&nbsp</span>Like bài viết</button>
            <span style="font-weight:bold; color:blue">Bài viết đã có '.$news_like_count->like_count.' lượt thích.</span>';
        }
        else {
            $like_status = LikeStatus::where('customer_id', $customer_id)->where('news_id', $news_id)->first();
            if(!$like_status) {
                $output = 
                '<button class="submit btn-like" id="send-like" type="submit">
                <i class="fas fa-thumbs-up" style="color:white"></i>
                <span>&nbsp</span>Like bài viết</button>
                <span style="font-weight:bold; color:blue">Bài viết đã có '.$news_like_count->like_count.' lượt thích.</span>';
            }
            else {
                if($like_status->like_status == 1) {
                    $output = 
                    '<button class="submit btn-like" id="send-not-like" type="submit">
                    <i class="fas fa-thumbs-up" style="color:blue"></i>
                    <span>&nbsp</span>Đã like</button>
                    <span style="font-weight:bold; color:blue">Bài viết đã có '.$news_like_count->like_count.' lượt thích.</span>';
                } else {
                    $output = 
                    '<button class="submit btn-like" id="send-like" type="submit">
                    <i class="fas fa-thumbs-up" style="color:white"></i>
                    <span>&nbsp</span>Like bài viết</button>
                    <span style="font-weight:bold; color:blue">Bài viết đã có '.$news_like_count->like_count.' lượt thích.</span>';
                }
            }
        }
        echo $output;
    }

    public function not_like_news(Request $request){
        $news_id = $request->news_id;
        $customer_id = $request->customer_id;

        $news_like_count = News::find($news_id);

        if($customer_id) {
            $like = LikeStatus::where('customer_id', $customer_id)->where('news_id', $news_id)->first();
            $like = LikeStatus::find($like->like_id);
            $like->like_status= 0;
            $like->save();
            $news_like_count->like_count = $news_like_count->like_count - 1;
            $news_like_count->save();
        } else {
            echo '<span style="color:red; font-weight: bold;">Hãy đăng nhập trước khi like.</span>';
        }
    }

    public function like_news(Request $request){
        $news_id = $request->news_id;
        $customer_id = $request->customer_id;

        $news_like_count = News::find($news_id);

        if($customer_id ) {
            $like = LikeStatus::where('customer_id', $customer_id)->where('news_id', $news_id)->first();
            if($like){
                $like = LikeStatus::find($like->like_id);
                $like->like_status= 1;
                $like->save();
                $news_like_count->like_count = $news_like_count->like_count + 1;
                $news_like_count->save();
            } else {
                $like = new LikeStatus();
                $like->news_id = $news_id;
                $like->customer_id = $customer_id;
                $like->like_status= 1;
                $like->save();
                $news_like_count->like_count = $news_like_count->like_count + 1;
                $news_like_count->save();
            }
        } else {
            echo '<span style="color:red; font-weight: bold;">Hãy đăng nhập trước khi like.</span>';
        }
    }
}
