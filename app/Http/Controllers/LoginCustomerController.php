<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
session_start();

class LoginCustomerController extends Controller
{
    /* Phượng */
    public function index() {
        return view('customer_login');
    }

    public function AuthLogin(){
        $customer_id = Session::get('customer_id');
        if($customer_id) {
            return Redirect::to('/trang-chu');
            
        } else {
            return Redirect::to('/login')->send();
        }
    }

    public function pagehome(Request $request){
        $data = $request->all();
        $customer_email = $data['customer_email'];
        $customer_password = md5($data['customer_password']);

        $customer = Customer::where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();

        if(isset($customer)){
            Session::put('customer_id', $customer->customer_id);
            Session::put('customer_first_name', $customer->customer_first_name);
            Session::put('customer_avatar', $customer->customer_avatar);
            return Redirect::to('trang-chu');
        } else {
            Session::put('message', 'Mật khẩu hặc tài khoản đã nhập không chính xác. Mời nhập lại.');
            return Redirect::to('login');
        }
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('customer_first_name', null);
        Session::put('customer_id', null);
        Session::put('customer_avatar', null);
        return Redirect::to('trang-chu');
    }
    /* End Phượng */

    /* Hùng */
    public function getDangKy(){
        
        return view('user.dangky');
    }
    public function postDangKy(Request $request){
        $cusall = Customer::all();
        
        $data = $request->validate([
            'customer_last_name'=>'required',
            'customer_first_name' => 'required',
            'customer_email' => 'required',
            'customer_password' => 'required',
            'customer_passwordAgain' => 'required',
          
            
        ],[
            'customer_last_name.required' => 'Tên không được để trống',
            'customer_first_name.required' =>'Tên không được để trống',
            'customer_email.required' => 'Email không được để trống',
            'customer_password.required' => 'Password không được để trống',
            'customer_password.requiredAgain' => 'Vui lòng nhập lại password',
            
    
        ]);
        for ($i = 0;$i<count($cusall);$i++){
            //$cusall là tất cả dữ liệu về customer trên db
            //Lặp để lấy ra từng customer
            //email

            if($data['customer_email'] == $cusall[$i]->customer_email){
                //Nếu email nhập = email có trên db thì báo lỗi
                return redirect('dangky')->with('success','email đã tồn tại');
                $olala;
            }
            //Còn ngược lại thì tiến hành thêm dữ liệu mới lên db  
        }
        
            if(!isset($olala)){
                if($data['customer_password']==$data['customer_passwordAgain']){
                    $user = new Customer();
                // $image = $data['customer_avatar'];
                // $extention = $image->getClientOriginalExtension();//Lấy đuôi mở rộng của hình ảnh
                // $name = time().'_'.$image->getClientOriginalName();
                // Storage::disk('public/')->put($name,File::get($image));
                $get_image = $request->file('customer_avatar');


                if ($get_image) {
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.', $get_name_image));
                    $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                    $get_image->move('uploads/CustomerAvatar/', $new_image);
                    $user->customer_avatar = $new_image;
                } else {
                    $user->customer_avatar = "no_avatar35.png";
                }
                
                $user->customer_last_name = $request->customer_last_name;
                $user->customer_first_name = $request->customer_first_name;
                $user->customer_email = $request->customer_email;
                $user->customer_password =md5($request->customer_password);
                $user->save();
                return redirect('dangky')->with('success','Đăng ký thành công');
                }
                else{
                    return redirect('dangky')->with('success','Password không trùng khớp');
                }  
            }
    }
    public function sendemail(){
        return view('user.sendemail');
    }
    public function postsendemail(Request $request){
        $email = $request->customer_email;
        $code = $request->code;
        $check = Customer::where('customer_email',$email)->first();
        if(!$check){
            return redirect('sendemail')->with('success','Email không tồn tại');
        }
        $code = bcrypt(md5(time().$email));
        $check->code = $code;
        $check->time_code = Carbon::now();
        $check->save();
        $url = route('passwordreset',['code' => $check->code,'customer_email'=>$email]);
        $data=[
            'route' =>$url
        ];
        Mail::send('user.formsendpass', $data, function($message) use($check){
	        $message->to($check->customer_email, 'Visitor')->subject('Đổi mật khẩu HomeReeview');
            $message->from('phungthehungc4@gmail.com','Hùng');
	    });
        return redirect('sendemail')->with('success','Vui lòng kiểm tra email để thay đổi mật khẩu');
    }
    public function passwordreset(){
        return view('user.passwordreset');
    }
    public function updateforgetpass(Request $request){
        $new_code = Str::random();
        $email = $request->customer_email;
        $finduser = Customer::where('customer_email',$email)->where('code',$request->code)->first();
        if($finduser){
            $finduser->customer_password = md5($request->customer_password);
            $finduser->code = $new_code;
            $finduser->save();
            return redirect('login')->with('success','Đổi mật khẩu thành công');
        }
        else{
            return redirect('sendemail')->with('success','Link đã quá hạn, vui lòng gửi lại email');
        }
        
        
    }
    /* End Hùng */
    
}
