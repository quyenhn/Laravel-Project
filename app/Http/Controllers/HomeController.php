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
    public function index()
    {   $user = Auth::user();
      //  $articles= DB::table('articles')->where('user_id',$user->id)->orderBy('updated_at','desc')->paginate(3);
      $articles=Article::where('user_id',$user->id)->orderBy('updated_at','desc')->paginate(3);
      return view('home')->with('articles',$articles); 
      // return view('home');
      // redirect('/articles');
    }
    //////////
    public function users()
    {
      $users=User::get();
      return view('user.users',compact('users'));
    }
    public function user($id)
    {

      $user = User::find($id);

      return view('user.usersView', compact('user'));

    }
    public function ajaxRequest(Request $request){


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
