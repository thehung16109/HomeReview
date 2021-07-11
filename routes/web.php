<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Phượng */
//Client
Route::get('/','HomeController@index' );
Route::get('/404','HomeController@error_page');
Route::get('/trang-chu', 'HomeController@index');

// Tìm kiếm
Route::post('/search', 'HomeController@search');

//Admin login
Route::get('/admin', 'LoginController@index');
Route::post('/admin-dashboard', 'LoginController@dashboard');
Route::get('/logout-admin', 'LoginController@logout_admin');

//Admin
Route::get('/add-admin', 'AdminController@add_admin');
Route::post('/save-admin', 'AdminController@save_admin');
Route::get('/all-admin', 'AdminController@all_admin');
Route::get('/edit-admin/{admin_id}', 'AdminController@edit_admin');
Route::post('/update-admin/{admin_id}', 'AdminController@update_admin');
Route::get('/delete-admin/{admin_id}', 'AdminController@delete_admin');
Route::post('/search-admin', 'AdminController@search_admin');

//Customer
// Route::get('/add-customer', 'CustomerController@add_customer');
// Route::post('/save-customer', 'CustomerController@save_customer');
Route::get('/all-customer', 'CustomerController@all_customer');
Route::get('/edit-customer/{customer_id}', 'CustomerController@edit_customer');
Route::post('/update-customer/{customer_id}', 'CustomerController@update_customer');
Route::get('/delete-customer/{customer_id}', 'CustomerController@delete_customer');
Route::post('/search-customer', 'CustomerController@search_customer');

//Location
Route::get('/add-location', 'LocationController@add_location');
Route::post('/save-location', 'LocationController@save_location');
Route::get('/all-location', 'LocationController@all_location');
Route::get('/unactive-location/{location_id}', 'LocationController@unactive_location');
Route::get('/active-location/{location_id}', 'LocationController@active_location');
Route::get('/edit-location/{location_id}', 'LocationController@edit_location');
Route::post('/update-location/{location_id}', 'LocationController@update_location');
Route::get('/delete-location/{location_id}', 'LocationController@delete_location');
Route::post('/search-location', 'LocationController@search_location');

//Category
Route::get('/add-category', 'CategoryController@add_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/all-category', 'CategoryController@all_category');
Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active-category/{category_id}', 'CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
Route::post('/search-category', 'CategoryController@search_category');

//Review
Route::get('/add-review', 'ReviewController@add_review');
Route::post('/save-review', 'ReviewController@save_review');
Route::get('/all-review', 'ReviewController@all_review');
Route::get('/show-review-images/{review_id}', 'ReviewController@show_review_images');
Route::get('/unactive-review/{review_id}', 'ReviewController@unactive_review');
Route::get('/active-review/{review_id}', 'ReviewController@active_review');
Route::get('/edit-review/{review_id}', 'ReviewController@edit_review');
Route::post('/update-review/{review_id}', 'ReviewController@update_review');
Route::get('/delete-review/{review_id}', 'ReviewController@delete_review');
Route::post('/search-review', 'ReviewController@search_review');
Route::get('/delete-review-image/{image}/{review_id}', 'ReviewController@delete_review_image');

//News
Route::get('/add-news', 'NewsController@add_news');
Route::post('/save-news', 'NewsController@save_news');
Route::get('/all-news', 'NewsController@all_news');
Route::get('/show-news-images/{news_id}', 'NewsController@show_news_images');
Route::get('/unactive-news/{news_id}', 'NewsController@unactive_news');
Route::get('/active-news/{news_id}', 'NewsController@active_news');
Route::get('/edit-news/{news_id}', 'NewsController@edit_news');
Route::post('/update-news/{news_id}', 'NewsController@update_news');
Route::get('/delete-news/{news_id}', 'NewsController@delete_news');
Route::post('/search-news', 'NewsController@search_news');
Route::get('/delete-news-image/{image}/{news_id}', 'NewsController@delete_news_image');

//Comment
Route::get('/all-comment', 'CommentController@all_comment');
Route::get('/unactive-comment/{comment_id}', 'CommentController@unactive_comment');
Route::get('/active-comment/{comment_id}', 'CommentController@active_comment');
Route::get('/delete-comment/{comment_id}', 'CommentController@delete_comment');

//Page Category
Route::get('/category/{category_slug}', 'ShowPageController@show_category_page');

//Page Location
Route::get('/location/{location_slug}', 'ShowPageController@show_location_page');

//Page Region
Route::get('/region/{region_slug}', 'ShowPageController@show_region_page');

//Page Author
Route::get('/author/{admin_id}', 'ShowPageController@show_author_page');

//Page Tags
Route::get('/tag/{tag}', 'ShowPageController@show_tag_page');
Route::get('/news-tag/{tag}', 'ShowPageController@show_news_tag_page');

//Page Review
Route::get('/review/{review_slug}', 'PageReviewController@show_review_page');
Route::post('/load-comment', 'PageReviewController@load_comment');
Route::post('/send-comment', 'PageReviewController@send_comment');
Route::post('/load-like-status', 'PageReviewController@load_like_status');
Route::post('/like-review', 'PageReviewController@like_review');
Route::post('/not-like-review', 'PageReviewController@not_like_review');

//Page News
Route::get('/news', 'PageNewsController@show_news');
Route::get('/news/{news_slug}', 'PageNewsController@show_news_page');
Route::post('/load-like-status-news', 'PageNewsController@load_like_status_news');
Route::post('/like-news', 'PageNewsController@like_news');
Route::post('/not-like-news', 'PageNewsController@not_like_news');

//Page Profile Customer
Route::get('/profile/{customer_id}', 'HomeController@show_profile_customer');
Route::post('/edit-profile', 'HomeController@edit_profile');
Route::post('/update-profile', 'HomeController@update_profile');
Route::post('/change-customer-avatar/{customer_id}', 'HomeController@change_customer_avatar');

//Page Tổng quan
Route::get('/dashboard', 'DashboardController@show_dashboard');

/* End Phượng */

/* Hùng */
//Customer Login
Route::get('/login', 'LoginCustomerController@index');
Route::post('/pagehome', 'LoginCustomerController@pagehome');
Route::get('/logout', 'LoginCustomerController@logout');

//Customer Register
Route::get('dangky','LoginCustomerController@getDangKy');
Route::post('dangky','LoginCustomerController@postDangKy')->name('dangky');
Route::post('update-password','LoginCustomerController@updateforgetpass')->name('updateforgetpass');

// Customer forget password
Route::get('sendemail','LoginCustomerController@sendemail')->name('getsendemail');
Route::post('postsendemail','LoginCustomerController@postsendemail')->name('sendemail');
Route::get('password/reset','LoginCustomerController@passwordreset')->name('passwordreset');
/* End Hùng */


