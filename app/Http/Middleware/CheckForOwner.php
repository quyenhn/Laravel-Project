<?php

namespace App\Http\Middleware;
use Auth;
use DB;
use Closure;
use App\Article;
class CheckForOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   $user = Auth::user();
        // $post=  DB::table('articles')->join('users','users.id','=','articles.user_id')->where('articles.id','id')->get() ;
        $article = Article::find($request->route('id'));
       // dd($article->user);
        if($user->id==$article->user_id)
        return $next($request);
        else
        return redirect()->route('notowner');
        
    }
}
