<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class LastUserActivity
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
        // if(Auth::guard('web')->check()) {
        //     $user=Auth::user();
        // $last_login_at=$user->last_login_at;
        // if(\Carbon\Carbon::now()->toDateString()>$last_login_at){
        //     \DB::table('users')
        //     ->where('id', Auth::id())
        //     ->update(['last_login_at' => \Carbon\Carbon::now()]);}
        // }

     if(\Auth::guard('web')->check()) 
    {   
        if(\Carbon\Carbon::now()->toDateString() > \Auth::user()->last_login_at)
        {
            dispatch(new \App\Jobs\Activity(\Auth::user()))->delay(\Carbon\Carbon::now()->addSecond(10));
        }
    }
    return $next($request);
    }
}