<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\Admin;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
Use Session;
use Auth;
use Mail;
use App\Mail\EmailVerificationMail;
use Carbon\Carbon;
session_start();
class UserController extends Controller
{
    public function Authentication() {
        $id = Auth::id();
        if($id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin-login')->send();
        }
    }

    public function add_users() {
        $this->Authentication();
        return view('admin.users.add_users');
    }

    public function list_users() {
        $this->Authentication();
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.users.list_users')->with('admin', $admin);
    }

    public function store_users(Request $request){
        $this->Authentication();
        $validator = Validator::make($request->all(), [
            'admin_name' => 'required|min:3|max:255|regex:/^([\p{Latin}]+[\ -]?)+[a-zA-Z]+$/u',
            'email' => 'required|email|max:255|min:3|regex:/(.*)@gmail\.com/i',
            'admin_password' => 'required|min:6|max:255:'
        ],
        [
            'admin_name.required' => 'Tên users không để trống !',
            'admin_name.min' => 'Tên users tối thiểu 3 kí tự !',
            'admin_name.max' => 'Tên users không quá 255 kí tự !',
            'admin_name.regex' => 'Tên users không nên để kí tự đặc biệt hoặc số !',
            'email.required' => 'Email không để trống !',
            'email.email' => 'Email không hợp lệ !',
            'email.max' => 'Email không quá 255 kí tự !',
            'email.min' => 'Email tối thiểu là 3 kí tự !',
            'email.regex' => 'Email bắt buộc là gmail(VD: example@gmail.com) !',
            'admin_password.required' => 'Mật khẩu không để trống !',
            'admin_password.min' => 'Mật khẩu tối thiểu 6 kí tự !',
            'admin_password.max' => 'Mật khẩu không quá 255 kí tự !'
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }
        else {
            $data = $request->all();
            $admin_email = Admin::where('email', $data['email'])->first();
            if($admin_email) {
                toast('Email đã tồn tại nhập email khác', 'error');
                return Redirect::to('/add-users');
            }
            else {
                $admin = new Admin();
                $admin->admin_name = $data['admin_name'];
                $admin->email = $data['email'];
                $admin->admin_password = md5($data['admin_password']);
                $admin->email_verification_code = Str::random(40); 
                $admin->is_active = 0;
                $admin->save();
                $admin->roles()->attach(Roles::where('name','user')->first());
                Mail::to($admin->email)->send(new EmailVerificationMail($admin));

                toast('Thêm tài khoản thành công. Vui lòng vào danh sách tài khoản để gửi email xác minh tài khoản vừa thêm!', 'success');
                return Redirect::to('/add-users');
            }
            
        }
       
    }

    //phân quyền
    public function assign_roles(Request $request){
        $this->Authentication();
        if(Auth::id() == $request->admin_id) {
            toast('Không được phân quyền!', 'error');
            return redirect()->back();
        }

        $user = Admin::where('email', $request->admin_email)->first();
        $user->roles()->detach();

        // if($request->author_role) {
        //    $user->roles()->attach(Roles::where('name','author')->first());     
        // }

        if($request->user_role) {
           $user->roles()->attach(Roles::where('name','user')->first());     
        }

        if($request->admin_role) {
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        
        toast('Cấp quyền thành công', 'success');
        return redirect()->back();
    }

    //xóa
    public function delete_user_roles($admin_id){
        $this->Authentication();

        $id_admin = Roles::find(1)->admin()->pluck('admin_id');

        // echo $id_admin;
        if(Auth::id()==$admin_id){
            toast('Không có quyền xóa!', 'error');
            return redirect()->back();
        }
        $admin = Admin::find($admin_id);

        if($admin) {
            $admin->roles()->detach();
            $admin->delete();
        }
        toast('Xóa Users thành công', 'success');
        return redirect()->back();

    }
    //chuyển quyền
    public function impersonate($admin_id){
        $this->Authentication();
        $user = Admin::where('admin_id', $admin_id)->first();
        if($user){
            session()->put('impersonate', $user->admin_id);
        }
        return redirect('/list-users');
    }
    public function impersonate_destroy(){
        $this->Authentication();
        session()->forget('impersonate');
        return redirect('/list-users');
    }

    public function verify_email($verification_code) {
        Auth::logout();
        Session::flush();
        $admin = Admin::where('email_verification_code', $verification_code)->select('email_verified_at')->first();
        if(!$admin) {
            toast('Đường dẫn xác minh Email không hợp lệ !', 'error');
            return redirect('/admin-login');
        } else {
            if($admin->email_verified_at) {
                toast('Tài khoản đã được xác minh !', 'success');
                return redirect('/admin-login');
            } else {
                date_default_timezone_set('asia/ho_chi_minh');
                Admin::where('email_verification_code', $verification_code)->update([
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
                toast('Xác minh tài khoản thành công !', 'success');
                return redirect('/admin-login');
            }
        }
    }

    public function resend_verify_email($id) {
        $this->Authentication();
        $admin = Admin::where('admin_id', $id)->select('email_verified_at')->first();
        if(!$admin) {
            toast('Đường dẫn gửi lại mã xác minh Email không hợp lệ !', 'error');
            return redirect('/list-users');
        }
        else {
            if($admin->email_verified_at) {
                toast('Tài hhoản đã được xác minh !', 'success');
                return redirect('/list-users');
            } else {
                date_default_timezone_set('asia/ho_chi_minh');
                Admin::where('admin_id', $id)->update([
                    'email_verification_code' => Str::random(40)
                ]);
                $admin_final = Admin::where('admin_id', $id)->select('admin_name', 'email_verification_code', 'email')->first();

                Mail::to($admin_final->email)->send(new EmailVerificationMail($admin_final));

                toast('Địa chỉ xác minh đã được gửi. Vui lòng kiểm tra địa chỉ email của bạn để xác minh tài khoản !', 'success');
                return redirect('/list-users');
            }
        }
    }
}
