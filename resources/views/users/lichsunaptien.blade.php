@extends('layouts.user')

@section('content')
<!-- BEGIN: Content-->
<!-- users list start -->
<div id="user-info">
    <div class="wrap-user-info wrap-history">
        <table class="table table-history" id="users-list-datatable">
            <thead>
                <tr>
                    <th>TÀI KHOẢN</th>
                    <th>NGÀY NẠP</th>
                    <th>LOẠI NẠP</th>
                    <th>SỐ TIỀN NẠP (VNĐ)</th>
                    <th>SỐ TIỀN TRONG GAME</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userCardChargeLogs as $log)
                <tr>
                    <td>{{$log->userAccount}}</td>
                    <td>{{$log->dateUpdate}}</td>
                    <td>{{$log->cardType}}</td>
                    <td>{{$log->value}}</td>
                    <td>{{$log->realValue}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!--wrap-user-info-->                        
</div>
<!-- users list ends -->

<!-- END: Content-->
@endsection
