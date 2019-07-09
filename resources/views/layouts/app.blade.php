<?php
$user = Auth::user();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('head.title') </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
   <!--  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('head.css')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- QBlog.com  --> <img src="https://3.bp.blogspot.com/-mqlRgMRUrrU/WfgN34irWfI/AAAAAAAADqQ/8KA6OXN6gMAgOi0qlRod1Z5qtId7Yqf6QCLcBGAs/s1600/blogger_icon.png" style="height: 30px;">
                     {{  config('app.name', 'QBlog.com') }} 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                        @if(\Auth::check())
                        <li><a href="{{route('article.create')}}">Create new article</a></li>
                        <li style="padding:0 1rem;"><a href="{{route('users')}}">List all users</a></li>
                        <li><a href="{{route('news_feed')}}">News feed</a></li>
                        @endif
                    
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else <img  src="/storage/avatars/{{ $user->avatar }}" style=" border-radius: 50%;width:50px;height: 50px;" alt="avatar"/>
                            <li class="nav-item dropdown">
                                
                          <!--   <li><img  src="/storage/avatars/{{ $user->avatar }}" style=" border-radius: 50%;width:50px;height: 50px;" alt="avatar"/></li> -->

                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{route('chat')}}">
                                        Chat room
                                    </a>

                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        Change avatar
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <div class="ajax-load text-center" style="display:none">
              <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More</p>
            </div>
        </main>
    </div>
    @include('partials.footer') 
    <!-- Scripts -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap4.min.js"></script>
<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/custom.js') }}" defer></script>
    @yield('body.js')
</body>
</html>
