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
    <meta name="ws_url" content="{{ env('WS_URL') }}">
    <meta name="user_id" content="{{ Auth::check() ? Auth::user()->id : 'null' }}">

    <title> @yield('head.title') </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap4.min.css')}}"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('head.css')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://3.bp.blogspot.com/-mqlRgMRUrrU/WfgN34irWfI/AAAAAAAADqQ/8KA6OXN6gMAgOi0qlRod1Z5qtId7Yqf6QCLcBGAs/s1600/blogger_icon.png" style="height: 30px;"/>
                {{  config('app.name', 'QBlog.com') }} 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto menu">

                        @if(\Auth::check())
                        <li class="nav-item"><a class="nav-link" href="{{route('article.create')}}">Create New Post</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('users')}}">Follow User</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('news_feed')}}">News Feed</a></li>
                        <!-- {{-- <li class="nav-item"><a class="nav-link" href="{{route('chat.public_chat')}}">PublicChat(SocketIO)</a></li> --}} -->
                        <li class="nav-item"><a class="nav-link" href="{{route('chat.index')}}">Private Chat(Echo-Pusher)</a></li>
                        <!-- {{-- <li class="nav-item"><a class="nav-link" href="{{route('socketchat.index')}}">Chat1-1(SocketIO)</a></li> --}} -->
                        <!-- <li class="nav-item"><a class="nav-link" href="{{route('messenger')}}">Private Chat(Nodejs-Socket.IO)</a></li> -->
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
                        @else 
                            <li class="nav-item"><img src="/storage/avatars/{{ $user->avatar }}" style=" border-radius: 50%;width:50px;height: 50px;" alt="avatar"/></li>
                            <li class="nav-item dropdown">
                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        Change avatar
                                    </a>

                                     <a class="dropdown-item" href="{{route('user.view',auth()->id())}}">
                                        My wall
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

        <main class="py-4" style="padding-top: 4.5rem !important;">
            @yield('content')
            <div class="ajax-load text-center" style="display:none">
              <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More</p>
            </div>
        </main>

        @include('partials.footer')
    </div> 
    <!-- Scripts -->
    <!-- <script src="/js/bootstrap4.min.js"></script> -->
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/custom.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}" ></script>

    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/socket.io.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    @yield('body.js')
</body>
</html>
