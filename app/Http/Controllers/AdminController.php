<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Admin;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Notifications\TwoFactorCode;
session_start();

class AdminController extends Controller
{
    public function Authentication() {
        $id = Auth::id();
        if($id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin-login')->send();
        }
    }

    public function logout() {
        $this->Authentication();
        Auth::logout();
        Session::flush();
        return Redirect::to('/admin-login');
    }

    public function index() {
         $id = Auth::id();
         if($id) {
             return Redirect::to('dashboard');
         } else {
            return view('admin_login');
        }
    }
    public function dashboard() {
        $this->Authentication();
        return view('admin.dashboard');
    }
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:3|max:255|regex:/(.*)@gmail\.com/i',
            'password' => 'required|min:3|max:255'
        ],
        [
            'email.required' => 'Email không để trống !',
            'email.email' => 'Email không hợp lệ !',
            'email.min' => 'Email tối thiểu là 3 kí tự !',
            'email.max' => 'Email tối đa là 255 kí tự !',
            'email.regex' => 'Email bắt buộc là gmail(VD: example@gmail.com)',
            'password.required' => 'Mật khẩu không để trống !',
            'password.min' => 'Mật khẩu tối thiểu là 3 kí tự !',
            'password.max' => 'Mật khẩu tối đa là 255 kí tự !'
            
        ]
        );
        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }
        else {
            $admin = Admin::where('email', $request->email)->select('email', 'email_verified_at', 'is_active', 'admin_password')->first();
            if(!$admin) {
                toast('Email không tồn tại !', 'error');
                return redirect('/admin-login');
            } else {
                if(!$admin->email_verified_at) {
                    toast('Email chưa được xác minh !', 'error');
                    return redirect('/admin-login');
                } else {
                    if(!$admin->is_active) {
                        toast('Tài khoản chưa được kích hoạt. Vui lòng liên hệ quản trị viên !', 'info');
                        return redirect('/admin-login');
                    } else {
                        if(Auth::attempt(['email' => $request->email, 'admin_password' => $request->password ])) {
                            $user = Auth::user();
                            $user->generateTwoFactorCode();
                            $user->notify(new TwoFactorCode());
                            return redirect('/dashboard');
                        } else {
                            toast('Mật khẩu nhập sai !', 'error');
                            return redirect('/admin-login');
                        }
                    }
                }
            }
            
        }
    }
    
}
