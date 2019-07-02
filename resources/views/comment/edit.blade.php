@extends ('layouts.app')

@section('head.title')
Chinh sua noi dung comment
@stop
@section('head.css')
<script src="https://cdn.ckeditor.com/4.11.4/full-all/ckeditor.js"></script>
@stop

@section('body.js')
<script>
     CKEDITOR.replace( 'editor' );
</script>
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-10 col-sm-offset-1">
			<h2>Edit comment</h2>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-10 col-sm-offset-1">
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<strong>Canh bao!</strong>Co loi nhap lieu.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
		 	<!-- <form action="{{route('article.store')}}" method="POST">
		 		<input type="hidden" name="_token" value="{{csrf_token()}}">
		 		<div class="form-group">
		 			<label for="title" class="control-label">Tieu de bai viet</label>
		 			<input class="form-control" type="text" name="title" id="title" required placeholder="Dien ten bai viet">
		 		</div>

		 		<div class="form-group">
		 			<label for="content" class="control-label">Noi dung bai viet</label>
		 			<input class="form-control" type="text" name="content" id="content" required placeholder="Dien nd bai viet">
		 		</div>
		 		<div class="form-group">
		 			<button class="btn btn-primary">Them bai viet</button> 
		 		</div>
		 	</form> -->
            
		 	{!! Form::model($comment,[
		 		'route'=>['comment.update',$comment->id],
		 		'method'=>'PUT',
		 		'class'=>'form-horizontal',
		 		'enctype'=>'multipart/form-data'
		 		])
		 		!!}
		 	<div class="form-group">
  {!! Form::label('edit_comment','Edit a Comment...',['class'=>'control-label'])!!}
  {!! Form::textarea('content', null ,['rows'=>'3','id'=>'editor','class'=>'form-control'])!!}
            </div>
<div class="form-group">
  {!! Form::submit('Update comment',['class'=>'btn btn-success'])!!}
</div>	
		    {!! Form::close()!!}
            
		 	</div>
		 </div>
		</div>
		@stop