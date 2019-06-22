<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
use DB;
use Auth;

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

}
