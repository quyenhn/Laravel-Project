@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Messenger with your friends <i class="fa fa-heart" style="color:red;" aria-hidden="true"></i></div>
				<div class="card-body">
					<audio id="ChatAudio">
						<!-- <source src="https://static.xx.fbcdn.net/rsrc.php/yy/r/XFhtdTsftOC.ogg"> -->
							<source src="https://static.xx.fbcdn.net/rsrc.php/yR/r/lvSDckxyoU5.ogg">
					</audio>
					<chat-app :user="{{ auth()->user() }}"></chat-app>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection