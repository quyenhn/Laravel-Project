 <img class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}" alt="avatar" />
                 
              
                        <span class="label label-default rank-label">{{$user->name}}</span>
                      
    {!! Form::open([
	'route'=>['user.follow',$user->id],
	'method'=>'POST',
	
	'class'=>'form-horizontal'
	])
	!!}
<button type="submit">Follow</button>
	
	{!! Form::close()!!}

	{!! Form::open([
	'route'=>['user.unfollow',$user->id],
	'method'=>'POST',
	
	'class'=>'form-horizontal'
	])
	!!}
<button type="submit">UnFollow</button>
	
	{!! Form::close()!!}
                  