<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Article;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticleFormRequest;
class ArticlesController extends Controller
{
	public function index()
	{   $articles=Article::orderBy('updated_at','desc')->paginate(3);   
     return view('articles.index')->with('articles', $articles);
	/*return view('articles.index',compact('articles')); */
	}

	public function show($id)
	{  // $article=Article::find($id);
	 //	$user = Auth::user();
	//	$user = User::all();
		
      $article = Article::find($id);
  //  $article=  DB::table('articles')->select('articles.id','title','content','articles.created_at','articles.updated_at','user_id','name')->join('users','users.id','=','articles.user_id')->where('articles.id',$id)->get() ;
	return view ('articles.show')->with('article',$article);
	}
	public function create()
	{
		return view('articles.create');
	}
	public function store(ArticleFormRequest $request)
	{   
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $imageName='user'.$user->id.'_image'.time().'_'.request()->image->getClientOriginalName();
		
		$title=$request->input('title');
		$description=$request->input('description');
		$request->image->storeAs('images',$imageName);
		$content=$request->input('content');
		$user_id=$user->id;
		Article::create([
			'title'=>$title,
			'description'=>$description,
			'image'=>$imageName,
			'content'=>$content,
			'user_id'=>$user_id
		]);
		return redirect()->route('home');
	}
	public function edit($id)
	{
		$article=Article::find($id);
		return view('articles.edit', compact('article') );
/*$article=  DB::table('articles')->select('articles.id','title','content','articles.created_at','articles.updated_at','user_id','name')->join('users','users.id','=','articles.user_id')->where('articles.id',$id)->get() ;
		return view ('articles.edit')->with('article',$article);*/
	}
	public function update($id,ArticleFormRequest $request)
	{   
		
        $user = Auth::user();

		$article=Article::find($id);

		// dd(request()->image);
        if($request->image != null){
        	$request->validate([
            	'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        	]);
        	$imageName='user'.$user->id.'_image'.time().'_'.request()->image->getClientOriginalName();
        	$request->image->storeAs('images',$imageName);
        }else{
        	$imageName = $article->image;
        }
        
		$article->update([
			'title' =>$request->get('title'),
			'description'=>$request->get('description'),
			'image'=>$imageName,
			'content'=>$request->get('content')
		]);
		return redirect()->route('home');
	}
	public function destroy($id)
	{
		$article=Article::find($id);
		Comment::where('article_id',$id)->delete();
		//$article->comment->delete();
		$article->delete();
		return redirect()->route('home');
	}
}
