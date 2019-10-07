@extends('layouts.app')

@section('head.title')
Danh sách bài viết
@stop

@section('content')
<div class="container">
{{-- @if (!\Auth::check()) --}}
  <div class="row justify-content-center">
    <div class="col-sm-6" >
      <i>Toàn bộ các bài đăng các user blog đã đăng tải: Tìm thấy {{$articles->total()}} bài viết!</i>
    </div>
  </div>
  
    <div class="row justify-content-center">
      <!--   {{-- <h2>{{$a->title}}</h2>
      <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}" />
      <small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}</small>
      <p> {{$a->description}} </p>
      <div style="font-size: 20px;">
        <a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
        &nbsp;
        <a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comment)}} comments</a>
      </div> --}} -->
      <div class="col-sm-10" id="post-data">@include('articles.data')</div>
    <!--  <div class="col-sm-3">
      <div class="card" style="position: sticky;top: 70px;">
        <div class="card-header">POST CATEGORY</div>
        <div class="card-body">
          <ul>
            <li>Cong nghe</li>
          </ul>
        </div>
      </div>
    </div> -->
    </div>   
<!-- {{--    
 @else  
  <div class="row ">
    <div class="col-sm-10 col-sm-offset-1">
      <i>Danh sach cac bai viet cua cac tac gia ban da theo doi: Tìm thấy {{$articles_following->total()}} bài viết</i>
    </div>
  </div> 
  @forelse ($articles_following as $f) 
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
      <h2>{{$f->title}}</h2>
      <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $f->image }}" />
      <small>Updated at: {{$f->updated_at}}, Author: {{$f->user->name}}</small>
      <p> {{$f->description}} </p>
      <div style="font-size: 20px;">
        <a href="{{route('article.show',$f->id)}}" style="text-decoration: underline;">Read more</a>
        &nbsp;
        <a href="{{route('article.show',$f->id)}}" style="text-decoration: underline;">{{count($f->comment)}} comments</a>
      </div>
    </div>
  </div>
  <hr> 
  @empty 
  <div class="col-sm-10 col-sm-offset-1 text-center">
   <b> Bạn chưa follow user nào hoặc người bạn theo dõi chưa đăng bài viết! </b>
 </div>
  @endforelse 
@endif   
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3 text-center">
    @if(isset($articles))
     {!! $articles->render()!!}  
    @else
     {!!$articles_following->render()!!}  
    @endif
    </div>
  </div>
--}} -->
</div> <!-- end of container -->
@stop

@section('body.js')
<script src="{{ asset('js/script.js') }}" ></script>
@stop