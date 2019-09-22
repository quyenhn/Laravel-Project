<?php

namespace App\Http\Middleware;

use Closure;
use App\Activity;
use Carbon\Carbon;
use Auth;
class StatisticsUserActive
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
        if (Auth::guard('web')->check()) 
        {
           //dd(Activity::where('user_id',Auth::id())->first()==null);
          /*  if(Activity::where('day',Carbon::now()->toDateString())->first()!=null)
            {   
                if(Activity::where('user_id',Auth::id())->first()==null)
                {
                Activity::where('day',Carbon::now()->toDateString())->create(array('user_id' =>   Auth::id()));
                }
            }
            else
            {
                Activity::create(['day' => Carbon::now()->toDateString(),
                                'user_id' => Auth::id() 
               ]);
           }*/
           
           if(Activity::where('user_id',Auth::id())->where('day',Carbon::now()->toDateString())->first()==null)
           {
                dispatch(new \App\Jobs\StatisticsActivity(Auth::user()));
           }

       }
       return $next($request);
   }
}
