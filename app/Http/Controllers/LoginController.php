<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function authCheck()
    {
        if (!auth()->check()) {
            abort(404);
        } else if (auth()->user()->isDisable()) {
            abort(403, 'This action is unauthorized.');
        }
    }

    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isDisable()) {
                abort(403, 'This action is unauthorized.');
            }
            return redirect()->route('admin.index');
        }
        // dd(bcrypt('123456'));
        return view('login.index');
    }

    public function signin(Request $request)
    {
        $this->validate(
            $request,
            [
                'login.email'        => 'required|email|string|max:255',
                'login.password'            => 'required|string|max:255'
            ],
            [
                'login.email.required' => 'E-mail không được bỏ trống.',
                'login.email.email' => 'E-mail không hợp lệ.',
                'login.email.string' => 'E-mail không hợp lệ.',
                'login.email.max' => 'E-mail không được lớn hơn 255 ký tự.',
                'login.password.required' => 'Mật khẩu không được bỏ trống.',
                'login.password.string' => 'Mật khẩu không hợp lệ.',
                'login.password.max' => 'Mật khẩu không được lớn hơn 255 ký tự.'
            ]
        );

        $remember = $request->has('remember-me') ? true : false;
        if (auth()->attempt(['email' => $request->input('login.email'), 'password' => $request->input('login.password')], $remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }
}
