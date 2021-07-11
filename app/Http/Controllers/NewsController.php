<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\News;
use App\Category;
use App\Location;
use App\Admin;
use App\Comment;
use App\GalleryImage;

session_start();

class NewsController extends Controller
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

    public function add_news()
    {
        $this->AuthLogin();
        return view('dashboard.news.add_news');
    }

    public function save_news(Request $request)
    {
        $this->AuthLogin();

        $data = $request->all();

        $all_news = News::get();
        foreach($all_news as $rev){
            if($rev->news_title==$data['news_title']){
                Session::put('message', 'Tin tức có tiêu đề trùng với tin tức khác');
                return redirect()->back();
            }
        }
        $news = new News();
        $news->news_title = $data['news_title'];
        $news->news_slug = $data['news_slug'];
        $news->news_desc = $data['news_desc'];
        $news->news_content = $data['news_content'];
        $news->news_tags = $data['news_tags'];
        $news->admin_id = Session::get('admin_id');
        $news->view_count = 0;
        $news->like_count = 0;

        if (isset($data['news_status'])) {
            $news->news_status = 1;
        } else {
            $news->news_status = 0;
        }

        if($files = $request->file('news_images')){
            $images = array();
            foreach ($files as $file) {
                $get_name_file = $file->getClientOriginalName();
                $name_file = current(explode('.', $get_name_file));
                $new_file = $name_file . rand(0, 99) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/NewsImage', $new_file);
                $images[]=$new_file;
            }
            $news->news_images = implode('|', $images);
        }
        else
        {
            $news->news_images="no_image23.png";
        }
        $news->save();
        Session::put('message', 'Thêm tin tức thành công.');
        return redirect()->back();
    }

    public function all_news()
    {
        $this->AuthLogin();
        $all_news = News::with('admin')->orderBy('news_id', 'DESC')->paginate(10);

        return view('dashboard.news.all_news', compact('all_news'));
    }

    public function show_news_images($news_id){
        $this->AuthLogin();
        $news = News::find($news_id);
        $news_title = $news->news_title;
        $news_images = explode("|", $news->news_images);

        return view('dashboard.news.show_news_image', compact('news_id', 'news_title', 'news_images'));
    }

    public function unactive_news($news_id)
    {
        $this->AuthLogin();
        $news = News::find($news_id);
        $news->news_status = 0;
        $news->save();
        Session::put('message', 'Thành công ẩn tin tức.');
        return redirect()->back();
    }

    public function active_news($news_id)
    {
        $this->AuthLogin();
        $news = News::find($news_id);
        $news->news_status = 1;
        $news->save();
        Session::put('message', 'Kích hoạt tin tức thành công.');
        return redirect()->back();
    }

    public function edit_news($news_id)
    {
        $this->AuthLogin();

        $edit_news = News::find($news_id);

        return view('dashboard.news.edit_news', compact('edit_news'));
    }

    public function update_news(Request $request, $news_id)
    {
        $this->AuthLogin();
        $data = $request->all();

        $all_news = news::get();
        foreach($all_news as $rev){
            if(($rev->news_id != $news_id) and ($rev->news_title==$data['news_title'])){
                Session::put('message', 'Cập nhật tin tức thành công.');
                return redirect()->back();
            }
        }
        $news = News::find($news_id);
        $news->news_title = $data['news_title'];
        $news->news_slug = $data['news_slug'];
        $news->news_desc = $data['news_desc'];
        $news->news_content = $data['news_content'];
        $news->news_tags = $data['news_tags'];

        if (isset($data['news_status'])) {
            $news->news_status = 1;
        } else {
            $news->news_status = 0;
        }

        if($files = $request->file('news_images')){
            $images = array();
            $files_old = explode("|", $news->news_images);
            foreach($files_old as $file_old){
                if($file_old != "no_image23.png") {
                    unlink('uploads/NewsImage/'.$file_old);
                }
            }
            foreach ($files as $file) {
                $get_name_file = $file->getClientOriginalName();
                $name_file = current(explode('.', $get_name_file));
                $new_file = $name_file . rand(0, 99) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/NewsImage', $new_file);
                $images[]=$new_file;
            }
            $news->news_images = implode('|', $images);
        }
        $news->save();
        Session::put('message', 'Cập nhật tin tức thành công.');
        return redirect('all-news');
    }

    public function delete_news($news_id)
    {
        $this->AuthLogin();

        $news = News::find($news_id);
        $news_images = $news->news_images;
        $files_old = explode("|", $news_images);
        if ($files_old) {
            foreach($files_old as $file_old){
                if($file_old != "no_image23.png") {
                    unlink('uploads/NewsImage/'.$file_old);
                }
            }
        }
        $news->delete();

        Session::put('message', 'Xóa tin tức thành công.');
        return redirect()->back();
    }

    public function search_news(Request $request) {
        $news = DB::table('tbl_news')
        ->join('tbl_admin', 'tbl_news.admin_id', '=', 'tbl_admin.admin_id')
        ->where('tbl_news.news_title', 'LIKE', '%'.$request->get('search').'%')
        ->orWhere('tbl_news.news_desc', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_news.news_tags', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_news.news_status', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_news.news_desc', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_admin.admin_last_name', 'LIKE','%'.$request->get('search').'%')
        ->orWhere('tbl_admin.admin_first_name', 'LIKE','%'.$request->get('search').'%')
        ->orderBy('tbl_news.news_title', 'ASC')->get();

        echo $news;
    }

    public function delete_news_image($image, $news_id)
    {
        $this->AuthLogin();

        $news = News::find($news_id);

        $news_images = $news->news_images;

        $files_old = explode("|", $news_images);
        $images = array();
        if ($files_old) {
            foreach($files_old as $file_old){
                if($file_old != "no_image23.png") {
                    if($file_old == $image){
                    unlink('uploads/NewsImage/'.$image);
                    } else {
                        $images[]=$file_old;
                    }
                }
            }
            $news->news_images = implode('|', $images);

        }
        $news->save();
        Session::put('message', 'Xóa hình ảnh của tin tức thành công.');
        return redirect()->back();
    }
}
