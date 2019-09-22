<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table='activity_log';
	
	protected $fillable=[
		'day',
		'user_id',
	];
	protected $casts = [
        'user_id' => 'array'
    ];
    public function user()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}
