<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table='followers';
    protected $fillable = [
        'follower_id', 'leader_id',
    ];
}
