@extends('layouts.master')
@section('head.title')
Danh sach bai viet
@stop
@section('body.content')
 <div class="container">
    <!-- if(count($articles)>0) -->
       @if (!\Auth::check())
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
                 <small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}</small>
               <p> {{$a->description}} </p>
                <div style="font-size: 20px;"><a href="{{route('article.show',$a->id)}}">Read more</a></div>
            </div>
        </div>
        <hr>
        @endforeach
        @else 
        <div class="row ">
              <div class="col-sm-8 col-sm-offset-2">
                  <i>Danh sach cac bai viet cua cac tac gia ban da theo doi:</i>
              </div>
          </div>
        @forelse ($articles_following as $f)
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2>{{$f->title}}</h2>
                <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $f->image }}" />
                 <small>Updated at: {{$f->updated_at}}, Author: {{$f->user->name}}</small>
               <p> {{$f->description}} </p>
                <div style="font-size: 20px;"><a href="{{route('article.show',$f->id)}}">Read more</a></div>
            </div>
        </div>
        @empty
        <div class="col-sm-8 col-sm-offset-2">
   <p> Bạn chưa follow user nào! </p>
 </div>
        <hr>
        @endforelse
        <!-- hien nhung bai viet cua nguoi dung follow -->
        @endif
  <!--   else
<div class="col-sm-6 col-sm-offset-3">
    <p>Sorry! No posts found in database!</p>
</div>
    endif  -->  
         <div class="row">
             <div class="col-sm-6 col-sm-offset-3 text-center">
              @if(isset($articles))
               {!! $articles->render()!!}
               @else
               {!!$articles_following->render()!!} 
               @endif
             </div>
         </div>
</div>

@stop