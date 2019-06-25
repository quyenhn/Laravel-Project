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
            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-info">Cap nhat</a>
          {!! Form::open([
            'route'=>['article.destroy',$article->id],
            'method'=>'DELETE',
            'style'=>'display:inline'
            ]) !!}
            <button class="btn btn-danger">Xoa</button>
          {!! Form::close() !!}
           </div>
        </div>
        @endif
           <!-- cho nay endforeach -->
      @if (\Auth::check())     
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
        <h4>Comments:</h4> 
       <!--  {!! Form::open([
            'route'=>['#',$article->id],
            'method'=>'',
            'style'=>'display:inline'
            ]) !!} -->
            <button class="btn btn-dark">Xoa</button>
          {!! Form::close() !!}       
        </div>
      </div>
      @endif
</div>
@stop