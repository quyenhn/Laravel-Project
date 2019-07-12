@extends('layouts.app')

@section('head.title')
Tuong ca nhan cua user
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     <img src="/storage/avatars/{{ $user->avatar }}" style="width:auto;height: 50px;" alt="avatar" />
                    {{ $user->name }}
                    <br/>
                    <small>
                        <strong>Email: </strong>{{ $user->email }}
                    </small>
                    <br>
        @if($user->id!=auth()->user()->id)
            <button class="btn btn-info btn-sm action-follow" data-id="{{ $user->id }}">
                      <strong> 
            @if(auth()->user()->isFollowing($user))
                UnFollow
            @else
                Follow
            @endif 
        @endif
                      </strong> 
            </button>
                </div>

                <div class="card-body">
                    <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#followers" role="tab" aria-controls="nav-home" aria-selected="true">Followers <span class="badge badge-primary">{{ $user->followers()->get()->count() }}</span></a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#following" role="tab" aria-controls="nav-profile" aria-selected="false">Following <span class="badge badge-primary">{{ $user->followings()->get()->count() }}</span></a>
                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="followers" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row pl-5">
                            @include('user.userList', ['users'=>$user->followers()->get()])
                        </div>
                      </div>
                      <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row pl-5">
                            @include('user.userList', ['users'=>$user->followings()->get()])
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   @if(count($articles)>0)
          <div class="row justify-content-center">
              <div class="col-sm-6" style="margin-top: 20px">
                  <i>Các bài viết của người dùng này: Tìm thấy {{$articles->total()}} bài viết!</i>
              </div>
          </div>
          <div class="row justify-content-center" id="post-data">
       {{-- @foreach ($user_articles as $a)
            <div class="col-sm-10">
                <h2>{{$a->title}}</h2>
                 <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}" />
                {{$a->description}} <br>
                <small>Update at: {{$a->updated_at}}</small><br>
                <!-- <p><a href="{{route('article.show',$a->id)}}">Read more</a></p> -->
                <div style="font-size: 20px;">
                  <a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
                  &nbsp;
                  <a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comment)}} comments</a>
                </div>
            </div>
            @endforeach --}}

        @include('articles.data')
          </div>
    @else
<div class="row justify-content-center"> 
  <div class="col-sm-6" style="margin-top: 20px">
    <i>User này chưa đăng tải bài viết nào!</i>
  </div>
</div>
    @endif   

    {{-- <div class="row justify-content-center">
           <div class="">
       {{$user_articles->links()}}
           </div>
         </div> --}}
</div>     <!-- end container -->    
@endsection

@section('body.js')
<script src="{{ asset('js/script.js') }}" ></script>
<!-- <script src="{{ asset('js/custom.js') }}" defer></script> -->
@endsection