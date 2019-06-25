@extends ('layouts.master')

@section('head.title')
Them bai viet moi vao blog
@stop

@section('head.css')
<script src="https://cdn.ckeditor.com/4.11.4/full-all/ckeditor.js"></script>
@stop

@section('body.js')
<script>
     CKEDITOR.replace('editor');
</script>
@stop

@section('body.content')
<div class="container">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<h1>Add new article</h1>
			<hr>
		</div>
	</div>
	<div class="row">
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

{!! Form::open([
	'route'=>['article.store'],
	'method'=>'POST',
	'enctype'=>'multipart/form-data',
	'class'=>'form-horizontal'
	])
	!!}

	@include ('articles._form',['button_name'=>'Create'])
	{!! Form::close()!!}

</div>
</div>
</div>
@stop