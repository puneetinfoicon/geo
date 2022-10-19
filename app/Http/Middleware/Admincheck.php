<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Admincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset(\Auth::user()->id)){
            return $next($request);
        }

        if(checkAdmin(\Session::get('api_token')) == 'True'){
            return $next($request);
        }else{
            \session()->flash('alert-class', 'success');
            \session()->flash('message', "Not authorise to view this page.");
            return redirect()->route('login-register');
        }


    }
}
