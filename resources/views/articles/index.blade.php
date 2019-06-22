@extends('layouts.master')
@section('head.title')
Danh sach bai viet
@stop
@section('body.content')
 <div class="container">
    @if(count($articles)>0)
                  <div class="row ">
              <div class="col-sm-6 col-sm-offset-3">
                  <i>Danh sach toan bo cac bai viet nguoi dung da tao:</i>
              </div>
          </div>
        @foreach ($articles as $a)
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2>{{$a->title}}</h2>
                <!-- <p>{{$a->content}}</p> -->
                <small>Updated at: {{$a->updated_at}}</small>
                <p><a href="{{route('article.show',$a->id)}}">Read more</a></p>
            </div>
        </div>
        @endforeach
    @else
<div class="col-sm-6 col-sm-offset-3">
    <p>Sorry! No posts found in database!</p>
</div>
    @endif   
         <div class="row">
             <div class="col-sm-6 col-sm-offset-3 text-center">
               {!! $articles->render()!!}
               <!-- {{$articles->links()}} -->
             </div>
         </div>
</div>

@stop