@extends('layouts.app')
@section('head.title')
News feed ca nhan
@endsection

@section('content')
<!-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> 
-->

<div class="container">
 @if(count($articles)>0)
 <div class="row justify-content-center">
  <div class="col-sm-10">
    <i>Các bài viết bạn đã tạo & các bài viết của các tác giả bạn đã follow: Tìm thấy {{$articles->total()}} bài viết!</i>
  </div>
</div>

<div class="row justify-content-center" id="post-data">
  {{--@foreach ($articles as $a)
    <div class="col-sm-10">
      <h2>{{$a->title}}</h2>
      <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}" />

      <small>Update at: {{$a->updated_at}}, Author: {{$a->user->name}}</small><br>
      {{$a->description}} <br>
      <div style="font-size: 20px;"> 
        <a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
        &nbsp;
        <a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">{{count($a->comments)}} comments</a>
      </div>
    </div>
    @endforeach--}}
    @include('articles.data')
  </div>

  @else
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <i>Bạn chưa đăng bài viết nào cũng chưa follow ai cả!</i>
    </div>
  </div>
  @endif   

  {{-- <div class="row justify-content-center">
    <div class="">
     {{$articles->links()}}
   </div>
 </div> --}}
</div> <!-- end container -->
@endsection

@section('body.js')
<script type="text/javascript" src="js/app.js"></script>
@stop