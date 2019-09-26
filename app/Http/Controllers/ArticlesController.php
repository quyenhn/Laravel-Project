<?php
namespace App\Http\Controllers;
use Auth;
use App\Article;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticleFormRequest;
class ArticlesController extends Controller
{  
	public function __construct()
    {
        $this->middleware('auth')->except('index','show');
        $this->middleware('checkforowner')->only('edit','update','destroy');
    }

	public function index(Request $request)
	{   
		/*if (!\Auth::check())
		{*/
			$articles=Article::
			 //['latestComments' => function($query) {$query->orderBy('updated_at','desc')->take(3);}])
			orderBy('updated_at','desc')->paginate(config('app.paginate_article'));  
////
			if ($request->ajax()) 
			{
				$view = view('articles.data',compact('articles'))->render();
				return response()->json(['html'=>$view]);
			}
/////
			return view('articles.index',compact('articles'));//->with('articles', $articles);
	/*	}
		else
		{ 
			$user_login=User::find(Auth::user()->id);
			$followings = $user_login->followings;
		 // dd($followings );
			$articles_following=Article::whereIn('user_id',$followings->pluck('id'))->orderBy('updated_at','desc')->paginate(3);
		//   dd($articles_following);	
			return view('articles.index')->with('articles_following', $articles_following);
		}*/
	}

	public function show($id)
	{  // $article=Article::find($id);
	 //	$user = Auth::user();
	//	$user = User::all();
		$article = Article::find($id);
  //  $article=  DB::table('articles')->select('articles.id','title','content','articles.created_at','articles.updated_at','user_id','name')->join('users','users.id','=','articles.user_id')->where('articles.id',$id)->get() ;
		if ($article==null) {
			return view ('errors.404');
		}else
		return view ('articles.show')->with('article',$article);
	}
	public function create()
	{
		return view('articles.create');
	}
	public function store(ArticleFormRequest $request)
	{   
		$request->validate([
			'image' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg|max:20000',
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
		return redirect()->route('news_feed');
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
			'img' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:20000',
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
	return redirect()->route('news_feed');
}
public function destroy($id)
{
	$article=Article::find($id);
		//Comment::where('article_id',$id)->delete();
		//$article->comment->delete();
	$article->delete();
	return redirect()->route('news_feed');
}
public function notowner()
{
	return "<center>Bạn không có quyền sửa/xóa nội dung của user khác!!!</center>";
}
}