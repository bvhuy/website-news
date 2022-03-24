<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

class AccessPermissionUser
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
        $id = Auth::id();
        if($id) {
            if(Auth::user()->hasRole('user')) {
                return $next($request);
            }
            return redirect('/dashboard');
        } else {
            return Redirect::to('admin-login')->send();
        }
    }
}
