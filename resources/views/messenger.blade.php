@extends('layouts.app')
@section('head.css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style media="screen">
    .online{
        color: #32CD32;
    }
    .ffside {
        height: 100%;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        width: 18em;
        overflow-x: hidden;
        padding-top: 50px;
    }
    .chat_box{
        width:260px;
        padding: 5px;
        position: fixed;
        bottom: 0px;
    }
    </style>
@stop
@section('content')
            <div id="chatApp">
                <div class="panel panel-default ffside">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body" style="padding:0px;">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="chatList in chatLists" style="cursor: pointer;" @click="chat(chatList)">@{{ chatList.name }}  <i class="fa fa-circle pull-right" v-bind:class="{'online': (chatList.online=='Y')}"></i>  <span class="badge" v-if="chatList.msgCount !=0">@{{ chatList.msgCount }}</span></li>
                            <li class="list-group-item" v-if="socketConnected.status == false">@{{ socketConnected.msg }}</li>
                        </ul>
                    </div>
                </div>
            </div>
@endsection

@section('body.js')
    <script src="{{ asset('js/chat.js') }}" charset="utf-8"></script>
@stop
