@extends('layouts.app')

@section('content')
<!-- <div class="container">
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
</div> -->

<div class="container">
   @if(count($articles)>0)
          <div class="row justify-content-center">
              <div class="col-sm-8">
                  <i>Các bài viết bạn đã tạo: Tìm thấy {{$articles->total()}} bài viết!</i>
              </div>
          </div>
        @foreach ($articles as $a)
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <h2>{{$a->title}}</h2>
                 <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}" />
                {{$a->description}} <br>
                <small>Update at: {{$a->updated_at}}</small><br>
                <div style="font-size: 20px;"> 
                <a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
                &nbsp;
                <a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">{{count($a->comment)}} comments</a>
                </div>
            </div>
        </div>
        @endforeach
       @else
       <div class="row justify-content-center">
<div class="col-sm-6 ">
    <p>Sorry! You no have any post in database!</p>
</div>
</div>
    @endif   

         <div class="row justify-content-center">
             <div class="">
                 {{$articles->links()}}
             </div>
         </div>
</div>

@endsection
