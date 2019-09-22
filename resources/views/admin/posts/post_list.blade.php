@extends('adminlte::page')



@section('title', 'Danh sach bai viet')



@section('content_header')

    <h1>Danh sách toàn bộ bài viết </h1>
	
@stop



@section('content')
 <div class="box">
        <div class="box-header with-border">
            <span>Tổng số bài viết </span><span class="badge badge-info">{{count($posts)}}</span>
        </div>
    <div class="box-body">
    <table id="table_id" class="table table-bordered display" data-order='[[ 4, "desc" ]]' data-page-length='10'>
        <thead>
        <tr>
        	<th>Ảnh đại diện</th>
            <th>Tiêu đề</th>
            <th>Mô tả</th>
            <!-- <th>Nội dung</th> -->
            <th>Tác giả</th>
            <th>Đăng lúc</th>
            <th>Cập nhật</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $item)
            
        <tr>
           <td style="vertical-align: middle;"><img src="/storage/images/{{ $item->image }}" style="width:80px;height: 50px;"></td>
           <td style="width: 200px; font-style: italic;">{{$item->title}}</td>
           <td>{{$item->description}}</td>
           {{--<td>{{$item->content}}</td>--}} 
           <td style="width: 120px;">{{$item->user->name}}</td>
           <td class="text-right" style="width: 65px;">{{$item->created_at}}</td>
           <td class="text-right" style="width: 65px;">{{$item->updated_at}}</td>
           <td><a class="btn btn-info" href="{{URL::route('article.show',$item->id)}}" target="_blank">Xem</a> 
            {!! Form::open([
                'route'=>['admin.delete_post',$item->id],
                'method'=>'DELETE',
                'style'=>'display:inline-block;margin-top:5px;'
                ]) !!}
                <button onclick="return confirm('Bài viết vi phạm điều khoản & tiêu chuẩn cộng đồng, Admin có chắc muốn xoá?')" class="btn btn-danger">Xóa</button>
                {!! Form::close() !!}
            </td>
        </tr>

        @endforeach
        </tbody>
    </table>
</div>
@stop



@section('css')

    
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
@stop



@section('js')

    <script type="text/javascript" charset="utf8" src="{{asset('js/dataTables.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
            });

        } );
    </script>

@stop