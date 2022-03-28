<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MailController extends Controller
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
        $this->authCheck();
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('admin.index');
        }
        return view('admin.mail.index');
    }

    public function verify(Request $request, $id)
    {
        $this->authCheck();
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->route('verification.index');
    }


    public function resend(Request $request)
    {
        $this->authCheck();
        if (auth()->user()->hasVerifiedEmail()) {
            abort(404);
        }
        auth()->user()->sendEmailVerificationNotification();


        if ($request->ajax()) {
            $response = [
                'title'      =>    'Thành công',
                'message'    =>    'Đã gửi lại email xác minh',
            ];
            return response()->json($response, 200);
        }

        return redirect()->back();
    }
}
