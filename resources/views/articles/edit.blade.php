@extends ('layouts.app')

@section('head.title')
Chinh sua noi dung
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
		<div class="col-sm-12 col-sm-offset-1">
			<h2>Edit article</h2>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-12 col-sm-offset-1">
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

		 	{!! Form::model($article,[
		 		'route'=>['article.update',$article->id],
		 		'method'=>'PUT',
		 		'class'=>'form-horizontal',
		 		'enctype'=>'multipart/form-data'
		 		])
		 		!!}
		 		@include('articles._form',['button_name'=>'Update'])
		 		{!! Form::close()!!}

		 </div>
	 </div>
</div>
@stop