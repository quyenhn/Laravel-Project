<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   
    protected $table='comments';
    protected $fillable=[
        'content'
    
    ];
    public function article()
    {
    	return $this->belongsTo('App\Article','article_id','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}
