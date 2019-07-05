<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class ProfileController extends Controller
{/*
 public function wall($profileId)
 {
  $user = User::find($profileId);
  return view('wall',compact('user',$user));
}
  
    public function followUser($profileId)
    {
      $user = User::find($profileId);
      if(! $user) {

       return redirect()->back()->with('error', 'User does not exist.'); 
     }

     $user->followers()->attach(auth()->user()->id);
     return redirect()->back()->with('success', 'Successfully followed the user.');}

     public function unFollowUser($profileId)
     {
      $user = User::find($profileId);
      if(! $user) {

       return redirect()->back()->with('error', 'User does not exist.'); 
     }
     $user->followers()->detach(auth()->user()->id);
     return redirect()->back()->with('success', 'Successfully unfollowed the user.');}
     public function show($userId)
     {
      $user = User::find($userId);
      $followers = $user->followers;
      $followings = $user->followings;    
      return view('showfollow', compact('user', 'followers' , 'followings'));
    }*/
  }
