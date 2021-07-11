<?php
/* Phượng */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Review;
use App\Category;
use App\Location;
use App\Admin;
use App\Comment;
use App\GalleryImage;

session_start();

class ReviewController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_review()
    {
        $this->AuthLogin();
        $all_category = Category::where('category_status', 1)->orderBy('category_name', 'ASC')->get();
        $all_location = Location::where('location_status', 1)->orderBy('location_name', 'ASC')->get();
        return view('dashboard.review.add_review', compact('all_category', 'all_location'));
    }

    public function save_review(Request $request)
    {
        $this->AuthLogin();

        $data = $request->all();

        $all_review = Review::get();
        foreach($all_review as $rev){
            if($rev->review_title==$data['review_title']){
                Session::put('message', 'Bài viết có tiêu đề trùng với bài viết khác');
                return redirect()->back();
            }
        }
        $review = new Review();
        $review->review_title = $data['review_title'];
        $review->review_slug = $data['review_slug'];
        $review->review_desc = $data['review_desc'];
        $review->review_content = $data['review_content'];
        $review->tags = $data['tags'];
        $review->category_id = $data['category_id'];
        $review->location_id = $data['location_id'];
        $review->admin_id = Session::get('admin_id');
        $review->view_count = 0;
        $review->like_count = 0;
        $review->comment_count = 0;

        if (isset($data['review_status'])) {
            $review->review_status = 1;
        } else {
            $review->review_status = 0;
        }

        if($files = $request->file('review_images')){
            $images = array();
            foreach ($files as $file) {
                $get_name_file = $file->getClientOriginalName();
                $name_file = current(explode('.', $get_name_file));
                $new_file = $name_file . rand(0, 99) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/ReviewImage', $new_file);
                $images[]=$new_file;
            }
            $review->review_images = implode('|', $images);
        }
        else
        {
            $review->review_images="no_image23.png";
        }
        $review->save();
        Session::put('message', 'Thêm bài viết thành công.');
        return redirect()->back();
    }

    public function all_review()
    {
        $this->AuthLogin();
        $all_review = Review::with('category')->with('location')->with('admin')->orderBy('review_id', 'DESC')->paginate(10);

        return view('dashboard.review.all_review', compact('all_review'));
    }

    public function show_review_images($review_id){
        $this->AuthLogin();
        $review = Review::find($review_id);
        $review_title = $review->review_title;
        $review_images = explode("|", $review->review_images);

        return view('dashboard.review.show_review_image', compact('review_id', 'review_title', 'review_images'));
    }

    public function unactive_review($review_id)
    {
        $this->AuthLogin();
        $review = Review::find($review_id);
        $review->review_status = 0;
        $review->save();
        Session::put('message', 'Thành công ẩn bài viết.');
        return redirect()->back();
    }

    public function active_review($review_id)
    {
        $this->AuthLogin();
        $review = Review::find($review_id);
        $review->review_status = 1;
        $review->save();
        Session::put('message', 'Kích hoạt bài viết thành công.');
        return redirect()->back();
    }

    public function edit_review($review_id)
    {
        $this->AuthLogin();

        $all_category = Category::where('category_status', 1)->orderBy('category_name', 'ASC')->get();
        $all_location = Location::where('location_status', 1)->orderBy('location_name', 'ASC')->get();
        $edit_review = Review::find($review_id);

        return view('dashboard.review.edit_review', compact('edit_review', 'all_category', 'all_location'));
    }

    public function update_review(Request $request, $review_id)
    {
        $this->AuthLogin();
        $data = $request->all();

        $all_review = Review::get();
        foreach($all_review as $rev){
            if(($rev->review_id != $review_id) and ($rev->review_title==$data['review_title'])){
                Session::put('message', 'Tiêu đề bài viết đã tồn tại.');
                return redirect()->back();
            }
        }
        $review = Review::find($review_id);
        $review->review_title = $data['review_title'];
        $review->review_slug = $data['review_slug'];
        $review->review_desc = $data['review_desc'];
        $review->review_content = $data['review_content'];
        $review->tags = $data['tags'];
        $review->category_id = $data['category_id'];
        $review->location_id = $data['location_id'];

        if (isset($data['review_status'])) {
            $review->review_status = 1;
        } else {
            $review->review_status = 0;
        }

        if($files = $request->file('review_images')){
            $images = array();
            $files_old = explode("|", $review->review_images);
            foreach($files_old as $file_old){
                if($file_old != "no_image23.png") {
                    unlink('uploads/ReviewImage/'.$file_old);
                }
            }
            foreach ($files as $file) {
                $get_name_file = $file->getClientOriginalName();
                $name_file = current(explode('.', $get_name_file));
                $new_file = $name_file . rand(0, 99) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/ReviewImage', $new_file);
                $images[]=$new_file;
            }
            $review->review_images = implode('|', $images);
        }
        $review->save();
        Session::put('message', 'Cập nhật bài viết thành công.');
        return redirect('all-review');
    }

    public function delete_review($review_id)
    {
        $this->AuthLogin();

        $review = Review::find($review_id);
        $review_images = $review->review_images;
        $files_old = explode("|", $review_images);
        if ($files_old) {
            foreach($files_old as $file_old){
                if($file_old != "no_image23.png") {
                    unlink('uploads/ReviewImage/'.$file_old);
                }
            }
        }
        $review->delete();

        Session::put('message', 'Xóa bài viết thành công.');
        return redirect()->back();
    }

    public function search_review(Request $request) {
        $review = DB::table('tbl_review')->join('tbl_category', 'tbl_review.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_location', 'tbl_review.location_id', '=', 'tbl_location.location_id')
        ->join('tbl_region', 'tbl_location.region_id', '=', 'tbl_region.region_id')
        ->join('tbl_admin', 'tbl_review.admin_id', '=', 'tbl_admin.admin_id')
        ->where('tbl_review.review_title', 'LIKE', '%'.$request->get('search').'%')
        ->orWhere('tbl_review.review_desc', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_review.tags', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_review.review_status', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_review.review_desc', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_category.category_name', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_location.location_name', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_region.region_name', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_admin.admin_last_name', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_admin.admin_first_name', 'LIKE','%'.$request->get('search').'%')
        ->orderBy('tbl_review.review_title', 'ASC')->get();

        echo $review;
    }

    public function delete_review_image($image, $review_id)
    {
        $this->AuthLogin();

        $review = Review::find($review_id);

        $review_images = $review->review_images;

        $files_old = explode("|", $review_images);
        $images = array();
        if ($files_old) {
            foreach($files_old as $file_old){
                if($file_old != "no_image23.png") {
                    if($file_old == $image){
                    unlink('uploads/ReviewImage/'.$image);
                    } else {
                        $images[]=$file_old;
                    }
                }
            }
            $review->review_images = implode('|', $images);

        }
        $review->save();
        Session::put('message', 'Xóa hình ảnh của bài viết thành công.');
        return redirect()->back();
    }


    
}
/* End Phượng */
