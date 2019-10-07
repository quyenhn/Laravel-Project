
<div class="form-group">
	{!! Form::label('title','Tieu de bai viet',['class'=>'control-label'])!!}
	{!! Form::text('title', null ,['id'=>'title','class'=>'form-control','placeholder'=>'Dien vao day tieu de','required'=>'true'])!!}
</div>
<div class="form-group">
	{!! Form::label('description','Mo ta bai viet',['class'=>'control-label'])!!}
	{!! Form::textarea('description', null ,['rows'=>'3','id'=>'description','class'=>'form-control','placeholder'=>'Dien vao day mo ta bai viet', 'required'=>'true'])!!}
</div>
<!-- <div class="form-group">
	{!! Form::label('category','The loai bai viet',['class'=>'control-label'])!!}
	{!! Form::text('category', null ,['id'=>'category','class'=>'form-control','placeholder'=>'Dien vao day the loai bai viet', 'required'=>'true'])!!}
</div> -->
<div class="form-group">
	<!-- <label>Hinh anh dai dien bai viet</label> -->
	{!! Form::label('image','Hinh dai dien bai viet',['class'=>'control-label'])!!} <br>
	<?php if(isset($article)) { ?> <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $article->image }}"/> <?php } ?>
	<!-- <input type="file" name="image"> -->
	{!! Form::file('image', null ,['class'=>'form-control','required'=>'true'])!!}
</div>
<div class="form-group">
	{!! Form::label('content','Noi dung bai viet',['class'=>'control-label'])!!}
	{!! Form::textarea('content', null ,['id'=>'editor','class'=>'form-control','placeholder'=>'Dien vao day noi dung','required'=>'true'])!!}
</div>
<div class="form-group">
	{!! Form::submit($button_name,['class'=>'btn btn-primary'])!!}
</div>