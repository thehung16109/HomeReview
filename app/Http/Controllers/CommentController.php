<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Review;
use App\Customer;
use App\Comment;
use App\News;

session_start();

class CommentController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function all_comment(){
        $this->AuthLogin();
        $all_comment = Comment::with('customer')->with('review')->orderBy('comment_id', 'DESC')->paginate(10);
        return view('dashboard.comment.all_comment', compact('all_comment'));
    }

    public function unactive_comment($comment_id){
        $this->AuthLogin();
        $comment = Comment::find($comment_id);
        $comment->comment_status = 0;
        $comment->save();
        Session::put('message', 'Thành công ẩn bình luận.');
        return redirect()->back();     
    }

    public function active_comment($comment_id){
        $this->AuthLogin();
        $comment = Comment::find($comment_id);
        $comment->comment_status = 1;
        $comment->save();
        Session::put('message', 'Kích hoạt bình luận thành công.');
        return redirect()->back();
    }

    public function delete_comment($comment_id){
        $this->AuthLogin();
        $comment = Comment::find($comment_id);
        $comment->delete();
        Session::put('message', 'Xóa bình luận thành công.');
        return redirect()->back();
    }
}
