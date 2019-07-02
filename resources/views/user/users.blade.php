@extends('layouts.app')
@section('head.title')
Danh sach user
@endsection

@section('content')

<script src="{{ asset('js/custom.js') }}" defer></script>


<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">List of Users, Total: {{$users->total()}} users</div>


                <div class="card-body">

                    <div class="row pl-5" id="post-data">

                       {{-- @include('user.userList', ['users'=>$users]) --}}

                       @include('user.data')

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('body.js')
<script src="{{ asset('js/app.js') }}"></script> 
@stop