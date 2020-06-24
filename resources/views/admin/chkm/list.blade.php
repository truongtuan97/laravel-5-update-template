@extends('layouts.app')

@section('content')
<!-- BEGIN: Content-->
<!-- users list start -->
<section class="users-list-wrapper">
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Khuyến mãi</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($chkms as $chkm)
                                <tr>
                                    <td>{{$chkm->id}}</td>
                                    <td>{{$chkm->ngay_bat_dau}}</td>
                                    <td>{{$chkm->ngay_ket_thuc}}</td>
                                    <td>{{number_format($chkm->khuyenmai, 2)}}</td>
                                    <td><a href="{{ route('management.chkm.edit', $chkm) }}"><i class="feather icon-edit-1"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
<!-- END: Content-->
@endsection
