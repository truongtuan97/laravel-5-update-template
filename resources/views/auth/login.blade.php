@extends('layouts.login')

@section('content')
<!-- <div class="form-login">
    <div class="title-form">
        <img src="assets/images/login-title.png">
    </div>
    <div class="form-group input-lock">
        <label>Tên Tài Khoản</label>
        <input type="text" class="form-control" placeholder="Nhập tên tk">
    </div>
    <div class="form-group input-lock">
        <label>Mật khẩu</label>
        <input type="password" class="form-control" placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <div class="login-social d-flex">
            <span>Có thể đăng nhập bằng </span>
            <ul class="list-unstyled d-flex mb-0">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="form-group text-center mb-4 mt-4">
        <a href="#"><img src="assets/images/btn-login.png"></a>
    </div>
    <div class="form-group">
        <a href="#" class="btn-register">Đăng Ký Tài Khoản</a>
    </div>
</div> -->

<form class="form-login" method="POST" action="{{ route('login') }}">
    @csrf    
    <div class="title-form">
        <img src="assets/images/login-title.png">
    </div>
    <div class="form-group input-lock">                            
        <label>Tên Tài Khoản</label>
        <input id="email" name="email" value="{{ old('email') }}" required autofocus type="text" 
            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Nhập tên tk" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập tài khoản</strong>
                </span>
            @enderror
    </div>
    <div class="form-group input-lock">
        <label>Mật khẩu</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
        name="password" required autocomplete="current-password" placeholder="Nhập mật khẩu" />        
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập mật khẩu</strong>
                </span>
            @enderror
    </div>
    <div class="form-group">
        <div class="login-social d-flex">
            <span>Có thể đăng nhập bằng </span>
            <ul class="list-unstyled d-flex mb-0">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="form-group text-center mb-4 mt-4">        
        <button type="submit" style="background: none; border: none; padding: 0;">
            <a href="#"><img src="assets/images/btn-login.png"></a>    
        </button>        
    </div>
    <div class="form-group">        
        <a href="{{ route('register') }}" class="btn-register">Đăng Ký Tài Khoản</a>
    </div>
</form>
@endsection
