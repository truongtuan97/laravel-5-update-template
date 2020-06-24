@extends('layouts.app')

@section('content')
<!-- BEGIN: Content-->

<!-- Basic form layout section start -->
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="bordered-layout-basic-form">Nạp Thẻ</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                @if (session('alert'))
                    @if (session('alert') == 'success')
                        <div class="alert alert-success mb-2" role="alert">
                            Update success.
                        </div>
                    @endif
                    @if (session('alert') == 'failed')
                        <div class="alert alert-danger mb-2" role="alert">
                            <strong>Oh snap!</strong> Update failed.
                        </div>
                    @endif
                @endif
                <div class="card-content collpase show">
                    <div class="card-body">
                        <form method="post" action="{{route('management.user.napcard', $user)}}" class="form form-horizontal form-bordered">
                          @csrf
                          {{ method_field('PATCH') }}

                            <div class="form-body">
                                <h4 class="form-section"><i class="feather icon-user"></i> Nạp Thẻ vào tài khoản người
                                    chơi</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Tài khoản</label>
                                    <div class="col-md-9">
                                        <input type="text" id="projectinput1" class="form-control" value={{ $user->cAccName }}
                                            placeholder="tài khoản" name="username" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="nExtPoint1">Số xu hiện có</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nExtPoint1" class="form-control" value={{ $user->nExtPoint1 }} name="info" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="cardType">Thể loại</label>
                                    <div class="col-md-9">
                                        <select id="cardType" name="cardType" class="form-control">
                                            <option value="none" selected="" disabled="">Chọn thể loại</option>
                                            <option value="zing">Thẻ zing (100%)</option>
                                            <option value="momo">momo (110%)</option>
                                            <option value="bank">chuyển khoản ngân hàng(110%)</option>
                                        </select>

                                        @error('cardType')
                                            <span class="feedback" style="color: #ff7588;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="soTien">Số tiền</label>
                                    <div class="col-md-9">
                                        <select id="soTien" name="soTien" class="form-control" value={{ $user->nExtPoint1 }}>
                                            <option value="0" selected="" disabled="">Chọn số tiền</option>
                                            @foreach($chargeValues as $chargeValue)
                                            <option value="{{ $chargeValue->value }}">{{ $chargeValue->option }}</option>
                                            @endforeach
                                        </select>
                                        @error('soTien')
                                            <span class="feedback" style="color: #ff7588;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions right">
                                <button type="button" class="btn btn-warning mr-1">
                                    <a href="{{ route('users') }}"><i class="feather icon-x"></i> Hủy</a>
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-square-o"></i> Nạp
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic form layout section end -->

<!-- END: Content-->
@endsection
