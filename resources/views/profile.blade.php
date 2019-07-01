@extends('layouts.app')
@section('head.title')
Cap nhat avatar ca nhan
@endsection

@section('content')

    <div class="container">
        <div class="row">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="profile-header-container">
                <div class="profile-header-img">

                    <div class="row">
                        <a href="{{url('/home')}}" class="btn btn-link">
                        <i class="fas fa-chevron-left"></i>
                        Back to home profile
                        </a>
                    </div>
                    <br>
                    <img class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}" alt="avatar" />
                    <!-- badge -->
                    <div class="rank-label-container text-center">
                        <br>
                        <span class="label label-default rank-label">{{$user->name}}</span>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="row justify-content-center">
            <form action="/profile" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection