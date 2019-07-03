<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
use App\User;
class PagesController extends Controller
{
    public function index()
    {   
    	return redirect('/articles');
    }
    public function search_user(Request $request)
    {
    	$keyword=$request->get('keyword');// \Request::get('keyword');
        if ($keyword==null) {
            return back();
        }
    	$users=User::where('name','like','%'.$keyword.'%')->get();//->paginate(15);
    	/*if ($request->ajax()) 
      	{ 
      		\Log::info('-----KeyWord -------' . $keyword);

        $view = view('user.data',compact('users'))->render();
        return response()->json(['html'=>$view]);
      	}*/
    	return view('user.search', ['keyword'=>$keyword,'users'=>$users]);
    }
    
}
