@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 col-offset-2">
			<div class="card card-default">
				<div class="card-header">
					List of all friends, Choose one user to chat
				</div>
				@forelse ($friends as $friend)
				<ul class="list-group">
					<li class="list-group-item"> 
						<a href="{{ route('socketchat.show', $friend->id) }}">
							{{$friend->name}}
						</a>

					</li>

				</ul>
				@empty
				<div class="card-block">
					You don't have any friends
				</div>
				@endforelse
			</div>
		</div>
	</div>
</div>
@endsection