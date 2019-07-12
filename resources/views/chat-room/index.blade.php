@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">Messenger with your friends <i class="fa fa-heart" style="color:red;" aria-hidden="true"></i></div>
				<div class="card-body" id="app">
					<audio id="ChatAudio">
						<source src="https://static.xx.fbcdn.net/rsrc.php/yy/r/XFhtdTsftOC.ogg">
					</audio>
					<chat-app :user="{{ auth()->user() }}"></chat-app>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection