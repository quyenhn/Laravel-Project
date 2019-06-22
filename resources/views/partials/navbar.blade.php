<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
$user = Auth::user();
?>

    <nav class="navbar navbar-default " role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('article.index') }}">List Blog</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    @if(\Auth::check())
                    <li><a href="{{route('article.create')}}">Create new article</a></li>
                    @endif
                </ul>
                <!-- <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form> -->
                <ul class="nav navbar-nav navbar-right">
                    @if(\Auth::guest())
                    <li><a href="{{url('/login')}}">Login</a></li>
                    <li><a href="{{url('/register')}}">Register</a></li>    
                   @else

        <li><img  src="/storage/avatars/{{ $user->avatar }}" style="border-radius: 50%;width:auto;height: 50px;" alt="avatar" /></li>

                   <li><a href="{{url('home')}}">{{"Xin chao ".\Auth::user()->name}}</a></li>
                    <li><a href="{{url('/logout')}}">Logout</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>