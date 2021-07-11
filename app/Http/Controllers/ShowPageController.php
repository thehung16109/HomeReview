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


class ShowPageController extends Controller
{
    /* Load trang danh mục */
    public function show_category_page($category_slug){
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

        // Lấy cho breadcrumb
        $category = Category::where('category_slug', $category_slug)->take(1)->get();
        foreach($category as $key => $cate){
            $category_id = $cate->category_id;
            $category_name = $cate->category_name;
        }

        //Show bài viết cho slide - bài viết nhiều like nhất
        $review_most_like = Review::where('review_status', 1)->where('category_id', $category_id)->orderBy('like_count', 'DESC')->take(5)->get();

        //Show bài viết thuộc danh mục
        $all_review_category = Review::with('location')->where('review_status', 1)->where('category_id', $category_id)->orderBy('review_id', 'DESC')->get();

        return view('pages.category', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 'category_name', 'review_most_like', 'all_review_category'));
    }
    /*End Load trang danh mục */

    /* Load trang địa điểm */
    public function show_location_page($location_slug){
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

        // Lấy cho breadcrumb
        $location = Location::with('region')->where('location_slug', $location_slug)->take(1)->get();
        
        foreach($location as $key => $loca){
            $location_id = $loca->location_id;
            $location_name = $loca->location_name;
            $region_name = $loca->region->region_name;
            $region_slug = $loca->region->region_slug;
        }
        //Show bài viết cho slide - bài viết nhiều like nhất
        $review_most_like = Review::where('review_status', 1)->where('location_id', $location_id)->orderBy('like_count', 'DESC')->take(5)->get();

        // Show bài viết thuộc địa điểm
        $all_review_location = Review::with('category')->where('review_status', 1)->where('location_id', $location_id)->orderBy('review_id', 'DESC')->get();

        return view('pages.location', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 'location_name', 'region_slug', 'region_name', 'review_most_like', 'all_review_location'));
    }
    /* End Load trang địa điểm */

    /* Load trang vùng miền */
    public function show_region_page($region_slug){
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

        // Lấy cho breadcrumb
        $region = Region::where('region_slug', $region_slug)->take(1)->get();
        foreach($region as $key => $reg){
            $region_id = $reg->region_id;
            $region_name = $reg->region_name;
        }

        //Show bài viết cho slide - bài viết nhiều like nhất
        $review_most_like = DB::table('tbl_review')->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->where('tbl_review.review_status', '=', 1)
        ->where('tbl_region.region_slug', '=',$region_slug)
        ->orderBy('like_count', 'DESC')
        ->take(5)->get();

        // Show bài viết thuộc vùng
        $all_review_region = DB::table('tbl_review')->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->join('tbl_category', 'tbl_review.category_id', '=', 'tbl_category.category_id')
        ->where('tbl_review.review_status', '=', 1)
        ->where('tbl_region.region_slug', '=',$region_slug)
        ->orderBy('tbl_review.review_id', 'DESC')->get();

        return view('pages.region', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 'region_name', 'review_most_like', 'all_review_region'));
    }
    /* End Load trang vùng miền */

    /* Load trang người viết bài */
    public function show_author_page($admin_id){
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
        $lastest_review = Review::where('review_status', 1)->orderBy('created_at', 'DESC')->take(8)->get();

        // Lấy cho breadcrumb
        $admin = Admin::where('admin_id', $admin_id)->take(1)->get();
        
        foreach($admin as $key => $ad){
            $admin_name = $ad->admin_last_name . ' ' . $ad->admin_first_name;
        }
        //Show bài viết cho slide - bài viết nhiều like nhất
        $review_most_like = Review::where('review_status', 1)->where('admin_id', $admin_id)->orderBy('like_count', 'DESC')->take(5)->get();

        // Show bài viết thuộc tác giả
        $all_review_author = Review::with('category')->with('location')->where('review_status', 1)->where('admin_id', $admin_id)->orderBy('review_id', 'DESC')->get();

        return view('pages.author', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 'admin_name', 'admin_id', 'review_most_like', 'all_review_author'));
    }
    /* End Load trang người viết bài */

    /* Load trang tag */
    public function show_tag_page($tag){
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

        //Show bài viết cho slide - bài viết nhiều like nhất
        $review_most_like = Review::where('review_status', 1)->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('like_count', 'DESC')->take(5)->get();

        // Lấy thông tin bài viết
        $all_review_tag = Review::with('category')->with('location')->where('review_status', 1)->where('tags', 'LIKE', '%'.$tag.'%')->get();

        return view('pages.tag', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_review', 
        'tag', 'review_most_like', 'all_review_tag'));
    }
    /* End Load trang tag */

    /* Load trang tag của news */
    public function show_news_tag_page($tag){
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

        // Show tin tức gần đây nhất
        $lastest_news = News::where('news_status', 1)->orderBy('created_at', 'DESC')->get();

        //Show tin tức cho slide - bài viết nhiều like nhất
        $news_most_like = News::where('news_status', 1)->where('news_tags', 'LIKE', '%'.$tag.'%')->orderBy('like_count', 'DESC')->take(5)->get();

        // Lấy thông tin tin tức
        $all_news_tag = News::where('news_status', 1)->where('news_tags', 'LIKE', '%'.$tag.'%')->get();

        return view('pages.tag', compact('all_category', 'all_location', 'all_review_bac', 'all_review_nam', 'lastest_news', 
        'tag', 'news_most_like', 'all_news_tag'));
    }
    /* End Load trang tag của news */
}
