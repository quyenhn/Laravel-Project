<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Str;
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
    {   
      //  $articles= DB::table('articles')->where('user_id',$user->id)->orderBy('updated_at','desc')->paginate(3);
    //  $articles=Article::where('user_id',$user->id)->get();//bai viet ban than

     // $user_login=User::find(Auth::user()->id);
     // $followings = $user->followings; //dd($followings);
        //bai viet cua nhung nguoi minh di follow ho.
     //$articles_following=Article::whereIn('user_id',$followings->pluck('id'))->get(); //dd($articles_following);
      
        // $articles_following = Article::whereHas('user.followers', function ($q) use ($userId) 
        // {
        //   return $q->where('follower_id', $userId);
        // })
        // ->get(); //dd($articles_following);
   // $articles = $articles->merge($articles_following)->sortByDesc('updated_at')->paginate(3);
      
   /* $articles=Article::where(['user_id','user.followers'])->where(function($q)
    {   $userId = Auth::user()->id;
      return  $q->where(['user_id'=>$userId,'follower_id'=>$userId]);
    });*/

 /*   $articles = Article::select('articles.*')  //('articles.id','title','description','content','image','articles.created_at','articles.updated_at','user_id')
    ->join('users', 'users.id', '=', 'articles.user_id')
    ->leftJoin('followers','users.id','=','followers.leader_id')
    ->where('user_id',auth()->user()->id)
    ->orWhere('followers.follower_id',auth()->user()->id)
    ->orderBy('updated_at','desc')->paginate(  config('app.paginate_article') );*/
  // dd($articles);
    $articles = Article::select('articles.*')
    ->join('followers','user_id','=','followers.leader_id')
    ->Where('followers.follower_id',auth()->user()->id)
    ->orderBy('updated_at','desc')->paginate(  config('app.paginate_article') ); 
    if ($request->ajax()) 
    {
      $view = view('articles.data',compact('articles'))->render();
      return response()->json(['html'=>$view]);
    }
    return view('user.news_feed')->with('articles',$articles); 
      // redirect('/articles');
    }

  public function users(Request $request)
  {
    $users=User::paginate(config('app.paginate_user'));
    if ($request->ajax()) 
    {
      $view = view('user.userList',compact('users'))->render();
      return response()->json(['html'=>$view]);
    }
    return view('user.users',compact('users'));
  }

  public function user($id, Request $request)
  {

    $user = User::find($id);
    if ($user==null)  return view('errors.404');
    $articles=$user->articles()->orderBy('updated_at','desc')->paginate(config('app.paginate_article'));

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

    $follow = Follow::where('leader_id', $user->id)->where('follower_id',auth()->user()->id)->first();

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
    public function search(Request $request)
    {
      $keyword=Input::get('keyword');
        if ($keyword==null) return back();
      $users=User::where('name','LIKE',"%$keyword%")->paginate(config('app.paginate_user'))->setpath('');
      if ($request->ajax()) 
        { 
          \Log::info('-----KeyWord -------' . $keyword);
        
        $view = view('user.userList',compact('users'))->render();
         //->withDetails($users)->withQuery($keyword)
        return response()->json(['html'=>$view]);
        }
      return view('user.search',['users'=>$users, 'keyword'=>$keyword]);
      //redirect('/users')->withInput();
    }
}