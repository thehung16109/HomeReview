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

class HomeController extends Controller
{
    /* Phượng */
    public function error_page(){
        return view('errors.404');
    }

    /* Load trang chủ */
    public function index() {
        //Lấy cho header
        $all_category = Category::where('category_status', 1)->orderBy('category_id', 'ASC')->take(5)->get();
        $all_location = Location::where('location_status', 1)->orderBy('location_name', 'ASC')->take(20)->get();

        //Lấy cho footer
        $all_review_bac = DB::table('tbl_review')->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->where('tbl_review.review_status', '=', 1)
        ->where('tbl_region.region_name', '=',"Miền Bắc")
        ->orderBy('tbl_review.created_at', 'DESC')
        ->take(4)->get();
        $all_review_nam = DB::table('tbl_review')->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->where('tbl_review.review_status', '=', 1)
        ->where('tbl_region.region_name', '=',"Miền Nam")
        ->orderBy('tbl_review.created_at', 'DESC')
        ->take(4)->get();

        //Lấy bài viết mới nhất
        $lastest_review = Review::where('review_status', 1)->orderBy('created_at', 'DESC')->take(6)->get();

        //Lấy bài viết nhiều view nhất
        $mostview_review = Review::where('review_status', 1)->orderBy('view_count', 'DESC')->take(6)->get();
        $mostview_review_1 = array();
        $mostview_review_2 = array();
        foreach($mostview_review as $key => $mostview){
            if ($key < 3) {
                $mostview_review_1[] = $mostview;
            } else {
                $mostview_review_2[] = $mostview;
            }
        }

        //Lấy bài viết nhiều like nhất
        $mostlike_review = Review::where('review_status', 1)->orderBy('like_count', 'DESC')->take(6)->get();

        //Lấy tin tức mới nhất
        $lastest_news = News::where('news_status', 1)->orderBy('created_at', 'DESC')->take(6)->get();
        $lastest_news_1 = array();
        $lastest_news_2 = array();
        foreach($lastest_news as $key => $lastest){
            if ($key < 3) {
                $lastest_news_1[] = $lastest;
            } else {
                $lastest_news_2[] = $lastest;
            }
        }
        
        return view('pages.home', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 
        'mostview_review_1', 'mostview_review_2',
        'mostlike_review',
        'lastest_news_1', 'lastest_news_2'));
    }
    /* End Load trang chủ */

    /* Tìm kiếm */
    public function search(Request $request) {
        $review = Review::where('review_status', 1)->where('review_title', 'like', '%'.$request->get('search').'%')->get();
        echo $review;
    }
    /* End Tìm kiếm */





    public function show_profile_customer($customer_id){
        //Lấy cho header
        $all_category = Category::where('category_status', 1)->orderBy('category_name', 'ASC')->take(5)->get();
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

        $profile = Customer::where('customer_id', $customer_id)->first();

        $liked = LikeStatus::where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();
        $review_liked=array();
        foreach($liked as $key => $like) {
            $review_liked[]= Review::where('review_id', $like->review_id)->first();
        }

        $commented = Comment::with('review')->where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();

        return view('pages.profile', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'profile', 'review_liked', 'commented'));
    }

    public function edit_profile(Request $request){
        $click = $request->click_status;
        $customer_last_name = $request->customer_last_name;
        $customer_first_name = $request->customer_first_name;
        $customer_email = $request->customer_email;

        if($click == 1){
        $output = '
        <div class="col-md-5 col-lg-5 col-xl-5">
                            <div class="form-group">
                                <label>Họ</label><span>*</span>
                                <input type="text" class="form-control last-name-new" value='.$customer_last_name.' required>
                            </div>
                            <div class="form-group">
                                <label>Tên</label><span>*</span>
                                <input type="text" class="form-control first-name-new" value='.$customer_first_name.' required>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-xl-7">
                            <div class="mt-0">
                                <div class="form-group">
                                    <label>Địa chỉ email</label><span>*</span>
                                    <input type="email" class="form-control email-new" aria-describedby="emailHelp"
                                        value='.$customer_email.' required>
                                </div>
                                <div class="form-group mt-1">
                                    <label">Mật khẩu mới</label>
                                        <input type="password" class="form-control pass-new">
                                </div>
                                <div class="col-md-11 col-lg-11 col-xl-11 mt-3">
                                    <button type="submit" class="submit btn-comment update-profile"
                                        style="text-align:center">Cập nhật</button>
                                </div>
                            </div></div>';
        } else {
            $output = '';
        }
        
        echo $output;
    }

    public function update_profile(Request $request){
        $data = $request->all();
        $customer = Customer::find($data['customer_id']);
        $customer->customer_last_name = $data['customer_last_name'];
        $customer->customer_first_name = $data['customer_first_name'];
        $all_customer = Customer::get();

        $output = '';
        foreach($all_customer as $cust){
            if(($cust->customer_id != $data['customer_id']) and ($cust->customer_email==$data['customer_email'])){
                $output =  '<span style="color:red; font-weight: bold;">Địa chỉ email này đã tồn tại trong dữ liệu.</span>';
            }
            else{
                $customer->customer_email = $data['customer_email'];
                $customer->customer_password = md5($data['customer_password']);

                $customer->save();
                $output = '<span style="color:red; font-weight: bold;">Cập nhật thông tin tài khoản thành công.</span>';
            }
        }
        echo $output;

    }

    public function change_customer_avatar(Request $request, $customer_id){
        $data = $request->all();
        $customer = Customer::find($customer_id);

        $get_image = $request->file('customer_avatar');

        if ($get_image) {
            //Xóa ảnh cũ
            if($customer->customer_avatar != "no_avatar35.png"){
                unlink('uploads/CustomerAvatar/'.$customer->customer_avatar);
            }
            //Cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName();
            $name_image= current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/CustomerAvatar', $new_image);
            $customer->customer_avatar = $new_image;
        }
        $customer->save();

        Session::put('customer_avatar', $customer->customer_avatar);
        //Lấy cho header
        $all_category = Category::where('category_status', 1)->orderBy('category_name', 'ASC')->take(5)->get();
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

        $profile = Customer::where('customer_id', $customer_id)->first();

        $liked = LikeStatus::where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();
        $review_liked=array();
        foreach($liked as $key => $like) {
            $review_liked[]= Review::where('review_id', $like->review_id)->first();
        }

        $commented = Comment::with('review')->where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();

        $request = null;
        $customer=null;
        $data = null;
        return view('pages.profile', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'profile', 'review_liked', 'commented'));
    }


    /* End Phượng */
}
