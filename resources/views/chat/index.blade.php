@extends('layouts.app')
@section('head.css')
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@endsection
@section('content')
<list-friend :list_friend="{{$friends}}" :onlineusers="onlineusers"></list-friend>
@endsection
@section('body.js')
<script src="/js/bootstrap4.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection