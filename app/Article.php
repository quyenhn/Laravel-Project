<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table='articles';
	
	protected $fillable=[
		'title',
		'description',
		'image',
		'content',
		'user_id'
	];
	/////////
	public function user()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
	public function comments()
	{
		return $this->hasMany('App\Comment','article_id','id');
	}
	public function latestComments()
	{
  		//return $this->comments()->latest()->nPerGroup('article_id', 3);
		return $this->hasMany('App\Comment','article_id','id')->orderByDesc('updated_at')->take(3);
	}
}