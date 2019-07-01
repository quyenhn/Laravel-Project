<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Comment;
class CheckForComment
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
        if($user==null) return redirect()->route('login');
        $comment = Comment::find($request->route('id')); 
        if($comment != null && $user->id==$comment->user_id)
            return $next($request);
        else
            return redirect()->route('notowner');
    }
}
