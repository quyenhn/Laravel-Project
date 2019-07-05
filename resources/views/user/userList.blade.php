@if($users->count())
    @foreach($users as $user)
        <div class="col-2 profile-box border p-1 rounded text-center bg-light mr-4 mt-3">
            <img src="/storage/avatars/{{ $user->avatar }}" class="w-100 mb-1" style="height: 180px;">
            <h5 class="m-0"><a href="{{ route('user.view', $user->id) }}"><strong>{{ $user->name }}</strong></a></h5>
            <p class="mb-2">
                <small>Following: <span class="badge badge-primary" id="following_{{$user->id}}">{{ $user->followings()->get()->count() }}</span></small>
                <small>Followers: <span class="badge badge-primary tl-follower">{{ $user->followers()->get()->count() }}</span></small>
            </p>
        @if($user->id!=auth()->user()->id)
             <button class="btn btn-info btn-sm action-follow" data-id="{{ $user->id }}"><strong> 
             @if(auth()->user()->isFollowing($user))
                UnFollow
            @else
                Follow
            @endif 
        @endif
            </strong></button>
        </div>
    @endforeach
    <div class="col-md-12">
   {{-- {{ $users->appends(request()->except('page'))->render() }}  --}}
</div>
@endif