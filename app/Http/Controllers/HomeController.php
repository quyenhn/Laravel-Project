<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   $user = Auth::user();
      //  $articles= DB::table('articles')->where('user_id',$user->id)->orderBy('updated_at','desc')->paginate(3);
      $articles=Article::where('user_id',$user->id)->get();
    
      $user_login=User::find(Auth::user()->id);
      $followings = $user_login->followings;
      $articles_following=Article::whereIn('user_id',$followings->pluck('id'))->get();
      // return view('articles.index')->with('articles_following', $articles_following);
      $articles = $articles->merge($articles_following)->sortByDesc('updated_at')->paginate(3);
      
      if ($request->ajax()) 
      {
        $view = view('articles.data',compact('articles'))->render();
        return response()->json(['html'=>$view]);
      }

      return view('home')->with('articles',$articles); 
      // redirect('/articles');
    }
    //////////
    public function users(Request $request)
    {
      $users=User::paginate(10);

      if ($request->ajax()) 
      {

        $view = view('user.data',compact('users'))->render();

            return response()->json(['html'=>$view]);

      }

      return view('user.users',compact('users'));
    }
    public function user($id, Request $request)
    {

      $user = User::find($id);
      if ($user==null)  return view('errors.404');
      $articles=$user->article()->orderBy('updated_at','desc')->paginate(3);

      if ($request->ajax()) 
      {

        $view = view('articles.data',compact('articles'))->render();
        return response()->json(['html'=>$view]);

      }

      return view('user.usersView', compact('user','articles'));

    }
    public function ajaxRequest(Request $request)
    {
      $user = User::find($request->user_id);

      $follow = Follow::where('leader_id', $user->id)->first();

      if($follow){
        $follow->delete();
        $status = 0;
      }else{
        $new = new Follow();
        $new->follower_id = auth()->user()->id;
        $new->leader_id = $user->id;
        $new->save();
        $status = 1;
      }
      $count=auth()->user()->followings()->get()->count();
      return response()->json(['status'=>$status,'count'=>$count, 'auth_id' => auth()->user()->id]);

    }

  }
