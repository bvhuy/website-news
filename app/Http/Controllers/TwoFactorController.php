<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TwoFactorCode;
class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['twofactor']);
    }

    public function Authentication() {
        $id = Auth::id();
        if($id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin-login')->send();
        }
    }

    public function index() 
    {
        $this->Authentication();
        return view('admin.auth.twoFactor');
    }

    public function store(Request $request)
    {
        $this->Authentication();
        $validator = Validator::make($request->all(), [
            'two_factor_code' => 'required|integer'
        ],
        [
            'two_factor_code.required' => 'Mã hai yếu tố không để trống !',
            'two_factor_code.integer' => 'Mã hai yếu tố bắt buộc là số !'
            
        ]);

        $user = auth()->user();

        if($request->input('two_factor_code') == $user->two_factor_code) {
            $user->resetTwoFactorCode();
            toast('Đăng nhập thành công !', 'success');
            return Redirect::to('dashboard');
        }

        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        toast('Mã hai yếu tố nhập không hợp lệ !', 'error');
        return redirect()->back();
    }

    public function resend()
    {
        $this->Authentication();
        $user = Auth::user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());
        toast('Mã hai yếu tố đã được gửi lại. Vui lòng kiểm tra địa chỉ Email của bạn để xác minh hai yếu tố !', 'success');
        return redirect()->back();
    }
}
