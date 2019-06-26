@extends('layouts.master')
@section('head.title')
Danh sach bai viet
@stop
@section('body.content')
 <div class="container">
    @if(count($articles)>0)
                  <div class="row ">
              <div class="col-sm-8 col-sm-offset-2">
                  <i>Danh sach toan bo cac bai viet nguoi dung da tao:</i>
              </div>
          </div>
        @foreach ($articles as $a)
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2>{{$a->title}}</h2>
                <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}" />
                {{$a->description}} <br>
                <small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}</small>
                <br>
                <div style="font-size: 20px;"><a href="{{route('article.show',$a->id)}}">Read more</a></div>
            </div>
        </div>
        <hr>
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