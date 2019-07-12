<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Article;
use Auth;
class CommentController extends Controller
{
    public function destroy($id)
    {
    	$comment=Comment::find($id);
    	$comment->delete();
        return redirect()->back();
    	//return redirect()->route('article.show',[$comment->article->id]);
    }
    public function store($article_id,Request $request)
    {
    	//$article_id=$article_id;
        //dd($article_id);
    	$comment=new Comment();
    	$comment->article_id=$article_id;
    	$comment->user_id=Auth::user()->id;
    	$comment->content=$request->content;
    	$comment->save();
    	return redirect("/articles/$article_id");
    }
    public function edit($id)
    {
    	$comment=Comment::find($id);
		return view('comment.edit', compact('comment') );
    }
    public function update($id,Request $request)
	{   
		$comment=Comment::find($id);
        
		$comment->update([
			'content'=>$request->get('content')
		]);
		return redirect()->route('article.show',[$comment->article->id]);
	}
}
