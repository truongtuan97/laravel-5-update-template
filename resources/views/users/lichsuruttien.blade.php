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
                    <th>SỐ XU TRƯỚC ĐÓ</th>
                    <th>SỐ XU RÚT</th>
                    <th>SỐ XU SAU KHI RÚT</th>
                    <th>NGÀY RÚT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userMoneyTakenLogs as $log)
                <tr>
                    <td>{{$log->AccountName}}</td>
                    <td>{{$log->OldMoney}}</td>
                    <td>{{$log->SubtractMoney}}</td>
                    <td>{{$log->NewMoney}}</td>
                    <td>{{$log->DateUpdate}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!--wrap-user-info-->                        
</div>
<!-- users list ends -->

<!-- END: Content-->
@endsection
