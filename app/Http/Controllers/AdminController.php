<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Admin;

session_start();

class AdminController extends Controller
{
    /* Phượng */
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_admin() {
        $this->AuthLogin();

        return view('dashboard.admin.add_admin');
    }

    public function save_admin(Request $request){
        $this->AuthLogin();

        $data = $request->all();

        $admin = new Admin();
        $admin->admin_last_name = $data['admin_last_name'];
        $admin->admin_first_name = $data['admin_first_name'];
        $all_admin = Admin::get();
        foreach($all_admin as $ad){
            if($ad->admin_email==$data['admin_email']){
                Session::put('message', 'Địa chỉ email này đã tồn tại trong dữ liệu');
                return redirect()->back();
            }
        }
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->admin_phone = $data['admin_phone'];

        $get_image = $request->file('admin_avatar');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/AdminAvatar', $new_image);
            $admin->admin_avatar = $new_image;
        } else {
            $admin->admin_avatar = "no_avatar35.png";
        }

        $admin->save();
        Session::put('message', 'Thêm tài khoản admin thành công.');
        return redirect()->back();
    }

    public function all_admin()
    {
        $this->AuthLogin();

        $all_admin = Admin::orderBy('admin_id', 'DESC')->paginate(10);
        return view('dashboard.admin.all_admin', compact('all_admin'));
    }

    public function edit_admin($admin_id)
    {
        $this->AuthLogin();
        $edit_admin = Admin::find($admin_id);
        return view('dashboard.admin.edit_admin', compact('edit_admin'));
    }

    public function update_admin(Request $request, $admin_id)
    {
        $this->AuthLogin();

        $data = $request->all();
        $admin = Admin::find($admin_id);
        $admin->admin_last_name = $data['admin_last_name'];
        $admin->admin_first_name = $data['admin_first_name'];
        $all_admin = Admin::get();
        foreach($all_admin as $ad){
            if(($ad->admin_id!=$admin->admin_id) and ($ad->admin_email==$data['admin_email'])){
                Session::put('message', 'Địa chỉ email này đã tồn tại trong dữ liệu');
                return redirect()->back();
            }
        }
        $admin->admin_email = $data['admin_email'];
 
        if($data['admin_password'] != null) {
            $admin->admin_password = md5($data['admin_password']);
        }

        $admin->admin_phone = $data['admin_phone'];

        $get_image = $request->file('admin_avatar');
        if ($get_image) {
            //Xóa ảnh cũ
            if($admin->admin_avatar!="no_avatar35.png") {
                unlink('uploads/AdminAvatar/'.$admin->admin_avatar);
            }
            
            //Cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName();
            $name_image= current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/AdminAvatar', $new_image);

            $admin->admin_avatar = $new_image;
        }
        $admin->save();
        Session::put('message', 'Cập nhật tài khoản admin thành công.');
        return redirect('all-admin');
    }

    public function delete_admin($admin_id)
    {
        $this->AuthLogin();

        if(Session::get('admin_id') == $admin_id) {
            Session::put('message', 'Đây là tài khoản của bạn. Không thể xóa tài khoản đang đăng nhập');
            return redirect()->back();
        }
        $admin = Admin::find($admin_id);
        $admin_avatar = $admin->admin_avatar;
        if ($admin_avatar) {
            if($admin_avatar!="no_avatar35.png") {
                unlink('uploads/AdminAvatar/'.$admin_avatar);
            }
            
        }
        $admin->delete();

        Session::put('message', 'Xóa tài khoản admin thành công.');
        return redirect()->back();
    }

    public function search_admin(Request $request) {
        $admin = Admin::where('admin_last_name', 'LIKE', '%'.$request->get('search').'%')
        ->orWhere('admin_first_name', 'LIKE', '%'.$request->get('search').'%')
        ->orWhere('admin_email', 'LIKE', '%'.$request->get('search').'%')
        ->orWhere('admin_phone', 'LIKE', '%'.$request->get('search').'%')
        ->orderBy('admin_last_name', 'ASC')->get();
        echo $admin;
    }

    /* End Phượng */
}
