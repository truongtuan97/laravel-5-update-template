@extends('layouts.login')

@section('content')
<!-- <div class="card-body">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        @csrf

        <fieldset class="form-group position-relative has-icon-left">                                
            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" value="{{ old('email') }}" required autofocus placeholder="tài khoản">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>Vui lòng nhập tài khoản</strong>
                    </span>
                @enderror
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password" required autocomplete="current-password" placeholder="mật khẩu">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập mật khẩu</strong>
                </span>
            @enderror
        </fieldset>                            

        <div class="form-group row">
            <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                <fieldset>                                        
                    <input class="form-check-input chk-remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember"> Ghi nhớ</label>
                </fieldset>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-primary btn-block">
            <i class="feather icon-unlock"></i> Đăng nhập
        </button>
    </form>
</div>
<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Chưa có tài khoản ?</span></p>
<div class="card-body">
    <a href="{{ route('register') }}" class="btn btn-outline-danger btn-block"><i class="feather icon-user"></i> Đăng ký</a>
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
