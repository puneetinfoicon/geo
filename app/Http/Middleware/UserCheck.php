<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Redirect, Session;

class UserCheck
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
        if (Auth::user() && Auth::user()->hasRole('admin')) 
        {
            session()->flash('alert-class', 'success');
            session()->flash('message', "Logout to go to login page.");
            return redirect('/admin');
        }elseif(Auth::user() && Auth::user()->hasRole('customer')){

            session()->flash('alert-class', 'success');
            session()->flash('message', "Logout to go to login page.");
            return redirect('/');
        }else{
            return $next($request);
        }
    }
}
