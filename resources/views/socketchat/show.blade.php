@extends('layouts.app')
@section('head.css')
<style>
	.card-body{
		height: 50vh;
		overflow-y: scroll;
	}
	.message{
		padding: 10pt;
		border-radius: 5pt;
		margin: 5pt;
	}
	.owner{
		background-color: #81c4f9;
		margin-left: auto !important;
	}
	.not_owner{
		background-color: #eaeff2;

	}
</style>
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 col-md-offset-2">
			<div class="card card-default">
				<div class="card-header">
					<b >
						{{$friend->name}} 
					</b>


					<a style="float: right;" href="{{ url('/socketchat') }}">
						<i class="fa fa-arrow-left"></i> Go back
					</a>
				</div>
				<div class="card-body" id="card-body">
					@foreach($msgs as $msg)
					<div class="row">
						<div class="message {{ ($msg->from!=auth()->user()->id)?'not_owner':'owner'}}">
							{{$msg->text}}<br/>
							<small>{{$msg->created_at}}</small>
						</div>
					</div>
					@endforeach
				</div>
				<div class="card-footer">
					<textarea id="msg" class="form-control" placeholder="Write your message"></textarea>
					<input type="hidden" id="csrf_token_input" value="{{csrf_token()}}"/>
					<br/>
					<div class="row justify-content-center">
						<div class="col-md-offset-4 col-md-4">
							<button class="btn btn-primary btn-block" onclick="button_send_msg()">Send</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('body.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>
    <script>
        var socket = io.connect('http://localhost:6999');

        socket.on("message", function (data) { console.log('--------mess-------',data);
            $('#card-body').append(
                    '<div class="row">'+
                    '<div class="message not_owner">'+
                    data.text+'<br/>'+
                    '<small>'+data.created_at+'</small>'+
                    '</div>'+
                    '</div>');

            scrollToEnd();

         });
    </script>
    <script>
        $(document).ready(function(){
            scrollToEnd();

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    var msg = $('#msg').val();
                    $('#msg').val('');//reset
                    send_msg(msg);
                }
            });
        });

        function button_send_msg(){
            var msg = $('#msg').val();
            $('#msg').val('');//reset
            send_msg(msg);
        }


        function send_msg(msg){
            $.ajax({
                headers: { 'X-CSRF-Token' : $('#csrf_token_input').val() },
                type: "POST",
                url: "{{route('socketchat.store')}}",
                data: {
                    'text': msg,
                    'to':{{$friend->id}},
                },
                success: function (data) {
                    if(data==true){

                        $('#card-body').append(
                                '<div class="row">'+
                                '<div class="message owner">'+
                                msg+'<br/>'+
                                '<small>now</small>'+
                                '</div>'+
                                '</div>');

                        scrollToEnd();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }

        function scrollToEnd(){
            var d = $('#card-body');
            d.scrollTop(d.prop("scrollHeight"));
        }

    </script>
@endsection