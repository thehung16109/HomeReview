<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Admin;

session_start();

class LoginController extends Controller
{
    /* Phượng */
    public function index() {
        return view('admin_login');
    }

    public function dashboard(Request $request){
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);

        $admin = Admin::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();

        if(isset($admin)){
            Session::put('admin_id', $admin->admin_id);
            Session::put('admin_first_name', $admin->admin_first_name);
            Session::put('admin_avatar', $admin->admin_avatar);
            return Redirect::to('dashboard');
        } else {
            Session::put('message', 'Mật khẩu hặc tài khoản đã nhập không chính xác. Mời nhập lại.');
            return redirect('admin');
        }
    }

    public function logout_admin(){
        $this->AuthLogin();
        Session::put('admin_first_name', null);
        Session::put('admin_id', null);
        Session::put('admin_avatar', null);
        return Redirect::to('/admin');
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
}
