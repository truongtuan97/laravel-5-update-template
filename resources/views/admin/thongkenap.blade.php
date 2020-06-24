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

                    <form method="post" class="form form-horizontal" action="{{route('management.thongkenap.list')}}">
                        @csrf
                        <div class="row form-group">
                            <div class="col md-4">
                                <div class="row">
                                    <div class="col md-4">
                                        <label for="fromDate"
                                            class="col-form-label text-md-right">{{ __('Ngày bắt đầu') }}</label>
                                    </div>
                                    <div class="col -md-6">
                                        {{old('fromDate')}}
                                        <input id="fromDate" type="text" name="fromDate"                                        
                                            class="pick-a-date bg-white form-control" value="{{ !empty($fromDate) ? 
                                                Carbon\Carbon::parse($fromDate)->format('m/d/Y') :
                                                Carbon\Carbon::parse(Carbon\Carbon::Now())->format('m/d/Y') }}">
                                    </div>

                                </div>
                            </div>

                            <div class="col md-4">
                                <div class="row">
                                    <div class="col md-4">
                                        <label for="toDate"
                                            class="col-form-label text-md-right">{{ __('Ngày kết thúc') }}</label>
                                    </div>
                                    <div class="col md-6">
                                        <input id="toDate" type="text" name="toDate"
                                        class="pick-a-date bg-white form-control" value="{{ !empty($toDate) ? 
                                                Carbon\Carbon::parse($toDate)->format('m/d/Y') :
                                                Carbon\Carbon::parse(Carbon\Carbon::Now())->format('m/d/Y') }}">
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Search') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="row form-group">
                        <div>Thống kê doanh thu</div>
                    </div>
                    <div class="row form-group bd-highlight">
                        <div class="col md-4">
                            <div class="row">
                                <div class="col md-12">
                                <label for="ngay_bat_dau" class="col-form-label text-md-right">Zing: <strong>{{ $zing }}</strong></label>
                                </div>
                            </div>
                        </div>

                        <div class="col md-4">
                            <div class="row">
                                <div class="col md-12">
                                    <label for="ngay_bat_dau" class="col-form-label text-md-right">Momo: <strong>{{ $momo }}</strong></label>
                                </div>
                            </div>
                        </div>

                        <div class="col md-4">
                            <div class="row">
                                <div class="col md-12">
                                    <label for="ngay_bat_dau" class="col-form-label text-md-right">Bank: <strong>{{ $bank }}</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Ngày nạp</th>
                                    <th>Loại thẻ</th>
                                    <th>Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cardChargeLogs as $log)
                                <tr>
                                    <td>{{$log->id}}</td>
                                    <td>{{$log->dateUpdate}}</td>
                                    <td>{{$log->cardType}}</td>
                                    <td>{{$log->value}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> -->
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->

<!-- END: Content-->
@endsection
