<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
class CheckBanned
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

        $response = $next($request);

        //If the status is not approved redirect to login 

        if(Auth::check() && Auth::user()->active != '1'){

            Auth::logout();

            $request->session()->flash('alert-danger', 'Tài khoản của bạn đã bị khoá. Vui lòng liên hệ Administrator!');

            return redirect('/login')->with('error_login', 'Your error text');

        }

        return $response;

    }


}
