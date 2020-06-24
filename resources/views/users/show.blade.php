@extends('layouts.user')

@section('content')

<div id="user-info">
    <div class="container">
        <div class="wrap-user-info">                                                               
            <div class="form-deposit">
                <div class="frm-left form-input-noicon">
                    <form method="post" action="{{route('users.update', $user)}}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <h4 class="title-center">THÔNG TIN TÀI KHOẢN</h4>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tên đăng nhập:</label>
                            <div class="col-sm-8">
                                <p>
                                    {{ $user->cAccName }}
                                </p>
                            </div>                            
                        </div>
                        
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Số điện thoại:</label>
                            <div class="col-sm-8">
                                <p>{{ $user->phone }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Số tiền hiện có:</label>
                            <div class="col-sm-8">
                                <p>{{ $user->nExtPoint1 }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-primary">Chỉnh Sửa</a>
                            </div>
                        </div>
                    </form>
                </div><!--frm-left-->
            </div>
        </div><!--wrap-user-info-->
    </div>
</div>
@endsection
