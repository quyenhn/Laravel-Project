@extends('adminlte::page')



@section('title', 'Thong tin tai khoan cua ban')



@section('content_header')

    <h1>My Profile</h1>

@stop



@section('content')
        
    <div class="box box-secondary">
        <div class="box-body">
            <ul class="list-group">
                <li class="list-group-item"><img src="/storage/avatars/{{ \Auth::guard('admin')->user()->avatar }}" style="width:30%;height:auto;margin-bottom: 5px;" alt="avatar"/>
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small><br>
                            <button type="submit" class="btn btn-primary">Change Avatar</button>
                        </div>
                    </form>
                </li>
                <li class="list-group-item">ID : {{\Auth::guard('admin')->user()->id}}</li>
                <li class="list-group-item">Username : {{\Auth::guard('admin')->user()->name}}</li>
                <li class="list-group-item">Email : {{\Auth::guard('admin')->user()->email}}</li>
                <li class="list-group-item">Ngày hoạt động : {{\Auth::guard('admin')->user()->created_at}}</li>
            </ul>
        </div>
    </div>

@stop



@section('css')

    

@stop



@section('js')

<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

@stop