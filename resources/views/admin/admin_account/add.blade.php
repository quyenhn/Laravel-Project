@extends('adminlte::page')



@section('title', 'Freelancer')



@section('content_header')

    <h1>Tạo tài khoản Admin</h1>
    <div class="alert alert-danger" {{(($errors->first()==null))?'hidden':''}}>
        {{$errors->first()}}
    </div>
@stop



@section('content')

    <div class="box">
        <form action="" method="post">
            <div class="box-body">
                <span class="label label-danger wi"></span>
                <div class="form-group {{($errors->has('username'))?'has-error':''}}">
                    {{--<span class="input-group-addon">@</span>--}}
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{old('username')}}" required>
                    <span class="help-block">{{$errors->first('username')}}</span>
                </div>
                <br>

                <div class="form-group {{($errors->has('password'))?'has-error':''}}">
                    {{--<span class="input-group-addon"><i class="fa fa-lock"></i></span>--}}
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <p class="help-block">{{$errors->first('password')}}</p>
                </div>
                <br>

                <div class="form-group {{($errors->has('email'))?'has-error':''}}">
                    {{--<span class="input-group-addon"><i class="fa fa-envelope"></i></span>--}}
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('username')}}" required>
                    <div><p class="help-block">{{$errors->first('email')}}</p></div>
                </div>
                <br>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary pull-right">Tạo tài khoản</button>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>

@stop



@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop



@section('js')



@stop