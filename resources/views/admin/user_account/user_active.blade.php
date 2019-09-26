@extends('adminlte::page')



@section('title', 'Danh sách người dùng hoạt động trong các ngày')



@section('content_header')
    {!! Charts::styles() !!}
    <h1>Danh sách User có hoạt động trên website trong các ngày</h1>
    <div class="alert alert-danger" {{(($errors->first()==null))?'hidden':''}}>
        {{$errors->first()}}
    </div>
@stop



@section('content')

    <div class="box">
        <div class="box-header with-border">
          <!-- {{--  <span>Tổng số tài khoản có hoạt động </span><span class="badge badge-info">{{count($dataUser)}}</span> --}} -->
          <label>Chọn ngày lọc dữ liệu</label>
        </div>
        <div class="box-body">
         <!-- {{--   <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Loại tài khoản</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataUser as $item)
                    
                    <tr>
                        <td class="text-center" width="5%">{{$item->id}}</td>
                        <td class="text-center">{{$item->name}}</td>
                        <td class="text-center">{{$item->email}}</td>
                        <td class="text-center">Writer</td>
                        <td class="text-center" width="5%">
                                <button type="button" class="btn {{($item->active==1)?"btn-success":"btn-danger"}} view-admin" data-username="{{$item->name}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-danger">
                                    {{($item->active==1)?"Unlocked":"Blocked"}}
                                </button>
                        </td>
                    </tr>
                    
                @endforeach
                </tbody>
            </table> --}} -->
            <form action="{{ route('admin.user_account.user_active') }}" method="GET">
            <span>Start date:</span>
            <span id="datepicker1" class="input-group date" data-date-format="yyyy-mm-dd"> <input value="{{ isset($startDate)?$startDate:
            Carbon\Carbon::today()->format('Y-m-d') }}" name="start_date" class="form-control" readonly="" type="text"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
            </span>
            <span>End date:</span>
            <span id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd"> <input value="{{ isset($endDate)?$endDate:
            Carbon\Carbon::today()->format('Y-m-d') }}" name="end_date" class="form-control" readonly="" type="text"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
            </span>
            <button type="submit" class="btn btn-info" style="margin-bottom: 10px;">Lọc</button>
            </form>
            
             @if(!empty($chart))
            {!! $chart->html() !!}
            {!! Charts::scripts() !!}
            {!! $chart->script() !!}
            @endif

            @if(!empty($alert_danger))
            <div class="alert alert-danger"> {{ $alert_danger }}</div>
            @endif
            @if (!empty($alert_warning))
            <div class="alert alert-warning"> {{ $alert_warning }}</div>
            @endif

            
            <table class="table">
                @if(!empty($dataUser))
                @foreach ($dataUser as $day => $users_list)
                <tr>
                    <th colspan="5"
                    style="background-color: #F7F7F7">{{ $day }}: {{ $users_list->count() }} users active</th>
                </tr>
                @foreach ($users_list as $user)
                <tr>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->user->email }}</td>
                    <td>Writer</td>
                    <td class="text-center" width="5%">
                        <button type="button" class="btn {{($user->user->active==1)?"btn-success":"btn-danger"}} view-admin" data-username="{{$user->user->name}}" data-id="{{$user->user->id}}" data-toggle="modal" data-target="#modal-danger">
                            {{($user->user->active==1)?"Unlocked":"Blocked"}}
                        </button>
                    </td>
                </tr>
                @endforeach
                @endforeach
                @endif
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-danger" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Block/Unlock tài khoản</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc muốn đôi trạng thái tài khoản <span style="color: red;" id='showusername'></span> không ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default yes" id="valueid">Có</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                </div>
            </div>
        </div>
    </div>
@stop



@section('css')
<link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
<style>
.input-group{
    display: inline-table;
}
#datepicker1,#datepicker2{
    width:150px; 
    margin: 0 20px 8px 10px;
    vertical-align: middle;
}
#datepicker > span:hover{
    cursor: pointer;
}
</style>

@stop



@section('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function () {  
        $("#datepicker1,#datepicker2").datepicker({         
            autoclose: true,         
            todayHighlight: true 
        });//.datepicker('update', new Date());
    });
</script>

    <script>
        $(document).on("click", ".view-admin", function() {
            var adminid = $(this).data('id');
            var adminusername = $(this).data('username');
            $(".modal-footer #valueid").val(adminid);
            $(".modal-body #showusername").text(adminusername);
            $('#modal-danger').modal('show');
        });
        $(document).on("click", ".yes", function(){
            $id = document.getElementById("valueid").value;
            $("#modal-danger").modal('hide');
            window.location.href="/admin/user_account/change_status/"+$id;
        });
    </script>

@stop