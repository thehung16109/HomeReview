<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use App\Customer;
use App\Review;
use App\News;
use App\Comment;

class DashboardController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return redirect('dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function show_dashboard(){
        $this->AuthLogin();
        $number_customer = Customer::count();
        $number_review = Review::count();
        $number_news = News::count();
        $number_comment = Comment::count();

        $today = Carbon::today();

        $number_new_customer = Customer::whereDate('created_at', $today)->count();
        $number_new_review =Review::whereDate('created_at', $today)->count();
        $number_new_news = News::whereDate('created_at', $today)->count();
        $number_new_comment = Comment::whereDate('created_at', $today)->count();

        $comment = Comment::with('customer')->with('review')->where('comment_status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $review = Review::with('admin')->where('review_status', 1)->orderBy('created_at', 'DESC')->take(10)->get();

        return view('dashboard.dashboard', compact('number_customer', 'number_review', 'number_news', 'number_comment', 
        'number_new_customer', 'number_new_review', 'number_new_news', 'number_new_comment',
        'comment', 'review'));
    }
}
