<?php
namespace App;
/*use Illuminate\Database\Eloquent\Model;
//
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;*/
//
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable /*Model implements //Authenticatable
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract*/
{   /*use Authenticatable, Authorizable, CanResetPassword;*/
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*protected $table = 'users';*/
    public function articles()
    {
        return $this->hasMany('App\Article','user_id','id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment','user_id','id');
    }
    /**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
    public function followers()
    {
    return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps();
    }
/**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
    public function followings()
    {
    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps();
    }
    public function isFollowing(User $user)
    {
    return  $this->followings()->where('leader_id', $user->id)->count();
    }   
    public function isFollowedBy(User $user)
    {
    return  $this->followers()->where('follower_id', $user->id)->count();
    }
    public function friends()
    {
        return $this->followers->merge($this->followings);
    }
    public function messages()
    {
      return $this->hasMany(Message::class);
    }
}