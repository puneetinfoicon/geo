<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Redirect, Session;

class VerifyAuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }elseif(Auth::user() && Auth::user()->hasRole('customer')){
            session()->flash('alert-class', 'success');
            session()->flash('message', "Not authorise to view this page.");
            return redirect('/');
        }else{
            session()->flash('alert-class', 'success');
            session()->flash('message', "Not authorise to view this page.");
            return redirect()->route('login-register');
        }
    }
}
