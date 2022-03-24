<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
// session_start();
class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if(Auth::check() && $user->two_factor_code)
        {
            date_default_timezone_set('asia/ho_chi_minh');
            if($user->two_factor_expires_at->lt(now()))
            {
                $user->resetTwoFactorCode();
                Auth::logout();
                Session::flush();
                toast('Mã hai yếu tố đã hết hạn. Xin vui lòng đăng nhập lại !', 'info');
                return redirect('/admin-login');
            }

            if(!$request->is('verify*'))
            {
                toast('Mã hai yếu tố đã được gửi. Vui lòng kiểm tra địa chỉ Email của bạn để xác minh hai yếu tố !', 'success');
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
