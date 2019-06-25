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
                  <i>Cac bai viet ban da tao:</i>
              </div>
          </div>
        @foreach ($articles as $a)
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <h2>{{$a->title}}</h2>
                 <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}" />
                <p>{{$a->description}}</p> 
                <small>Update at: {{$a->updated_at}}</small><br>
                <p><a href="{{route('article.show',$a->id)}}">Read more</a></p>
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
