<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table='articles';

/*	public $primaryKey='id';
	public $timestamps=true;*/

	protected $fillable=[
		'title',
		'description',
		'image',
		'content',
		'user_id'
	];
	/////////
	public function user(){
       return $this->belongsTo('App\User','user_id','id');
  	}
  	public function comment()
  	{
  		return $this->hasMany('App\Comment','article_id','id');
  	}
}