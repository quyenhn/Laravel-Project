@extends('layouts.app')

@section('head.title')
Danh sach user tim kiem duoc
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 form-inline justify-content-start">
                            <label> Search: {{$keyword}}, Results: {{$users->count()}} users </label>  
                        </div>

                        <div class="col-md-6 form-inline justify-content-end">
                            <label>Search:&nbsp; 
                                <form action="search_user" method="get" role="search">
                                <input type="text" name="keyword" class="form-control" placeholder="Type user name..."/>
                                <button class="icon" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row pl-5" >
                     @include('user.userList', ['users'=>$users])
                 </div>
             </div>
         </div>
     </div>
 </div>
 
</div>
@endsection

@section('body.js')
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ asset('js/custom.js') }}" defer></script> 
@stop