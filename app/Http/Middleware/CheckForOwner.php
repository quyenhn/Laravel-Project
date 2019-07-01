<?php

namespace App\Http\Middleware;
use Auth;
use DB;
use Closure;
use App\Article;
use App\Comment;
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
        if($user==null) return redirect()->route('login');
        // $post=  DB::table('articles')->join('users','users.id','=','articles.user_id')->where('articles.id','id')->get() ;
        $article = Article::find($request->route('id'));
        $comment = Comment::find($request->route('id')); 
        // dd($request->route('id'));
       // dd($article->user);
        if(($article != null && $user->id==$article->user_id)) // ||($comment != null && $user->id==$comment->user_id))
        return $next($request);
        else
        return redirect()->route('notowner');
        
    }
}
