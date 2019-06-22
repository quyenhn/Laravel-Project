
<div class="form-group">
	{!! Form::label('title','Tieu de bai viet',['class'=>'control-label'])!!}
	{!! Form::text('title', null ,['id'=>'title','class'=>'form-control','placeholder'=>'Dien vao day tieu de','required'=>'true'])!!}
</div>
<div class="form-group">
	{!! Form::label('content','Noi dung bai viet',['class'=>'control-label'])!!}
	{!! Form::textarea('content', null ,['id'=>'editor','class'=>'form-control','placeholder'=>'Dien vao day noi dung','required'=>'true'])!!}
</div>
<div class="form-group">
	{!! Form::submit($button_name,['class'=>'btn btn-primary'])!!}
</div>