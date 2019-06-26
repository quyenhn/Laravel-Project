<?php
namespace App\Http\Controllers;
use Collective\Html\FormFacade as Form;
use Auth;
$user = Auth::user();
?>
@extends('layouts.master')
@section('head.title')
Chi tiet bai viet
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
           <div class="col-sm-8 col-sm-offset-2">
               <a href="{{url('/home')}}" class="btn btn-link">
                   <i class="fas fa-chevron-left"></i>
                   Back to home user blog
               </a>
           </div>
       </div>
       <!--   cho nay la foreach neu dung DB::table  -->
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2>{{$article->title}}</h2>
                 <img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $article->image }}" />
                <small>Create at: {{$article->created_at}}, Update at: {{$article->updated_at}}, Author: {{$article->user->name}}</small>
                <br><br>
               <?php echo $article->content; ?>
            </div>
        </div>
        @if (\Auth::check() && $article->user_id==$user->id)
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-primary">Cập nhật bài viết</a>
          {!! Form::open([
            'route'=>['article.destroy',$article->id],
            'method'=>'DELETE',
            'style'=>'display:inline'
            ]) !!}
            <button class="btn btn-danger">Xóa bài viết</button>
          {!! Form::close() !!}
           </div>
        </div>
        @endif
           <!-- cho nay endforeach -->
           <hr>
      <div class="row">
         <div class="col-sm-8 col-sm-offset-2">
          <h4>Comments...</h4>
           @foreach($article->comment as $cm)
           <hr>
           <div>
           <img src="/storage/avatars/{{ $cm->user->avatar }}" style="width:auto;height: 50px;" alt="avatar" />
           <span>{{$cm->user->name}}</span><br>
           <small>{{$cm->updated_at}}</small>
           </div>
           <p><?php echo $cm->content ?></p>

            @if (\Auth::check() && $user->id==$cm->user_id)
        <div class="row">
          <div class="col-sm-8 ">
            <a href="{{ route('comment.edit', $cm->id) }}" class="btn btn-success">Sửa comment</a>
          {!! Form::open([
            'route'=>['comment.destroy',$cm->id],
            'method'=>'DELETE',
            'style'=>'display:inline'
            ]) !!}
            <button class="btn btn-warning">Xóa comment</button>
          {!! Form::close() !!}
           </div>
        </div>
          @endif

           @endforeach
         </div>        
      </div>
      @if (\Auth::check())     
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
       <!--  <h4>Leave a comment...</h4>  -->
<!--        <form action="comment/{{$article->id}}" method="POST" role="form">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
      <div class="form-group"> 
        <textarea class="form-control" rows="3" id="editorTest"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Gửi</button>         
       </form> -->
            {!! Form::open([
            'route'=>['comment.store',$article->id],
            'method'=>'POST',
            'style'=>'display:inline',
            
            ]) !!}
            
            <div class="form-group"><br>
  {!! Form::label('comment','Leave a Comment...',['class'=>'control-label'])!!}
  {!! Form::textarea('content', null ,['rows'=>'3','id'=>'editor','class'=>'form-control'])!!}
            </div>
<div class="form-group">
  {!! Form::submit('Add comment',['class'=>'btn btn-success'])!!}
</div>

          {!! Form::close() !!}
          
        </div>
      </div>
      @endif
</div>
@stop