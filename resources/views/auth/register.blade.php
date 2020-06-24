@extends('layouts.login')

@section('content')
<!-- <div class="card-body">
    <form method="POST" action="{{ route('register') }}" class="form-horizontal">
        @csrf

        <fieldset class="form-group position-relative has-icon-left">
            <input id="cAccName" type="text" class="form-control @error('cAccName') is-invalid @enderror"  placeholder="tài khoản"
                name="cAccName" value="{{ old('cAccName') }}" required autocomplete="cAccName" autofocus>
            @error('cAccName')
                <span class="invalid-feedback" role="alert">
                    <strong>Tài khoản đã tồn tại.</strong>
                </span>
            @enderror
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="email"
                value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="email" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="số điện thoại"
                value="{{ old('phone') }}" required autocomplete="phone">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập số điện thoại</strong>
                </span>
            @enderror
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="password1" type="password" class="form-control @error('password1') is-invalid @enderror" name="password1" 
                placeholder="mật khẩu cấp 1: 8 ký tự trở lên" required autocomplete="new-password">

            @error('password1')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập mật khẩu cấp 1</strong>
                </span>
            @enderror
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="password1-confirm" type="password" class="form-control" name="password1_confirmation" placeholder="nhập lại mật khẩu cấp 1"
                required autocomplete="new-password">
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="password2" type="password" class="form-control @error('password2') is-invalid @enderror" name="password2" 
                placeholder="mật khẩu cấp 2: 8 ký tự trở lên" required autocomplete="new-password">

            @error('password2')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập mật khẩu cấp 2</strong>
                </span>
            @enderror
        </fieldset>

        <fieldset class="form-group position-relative has-icon-left">
            <input id="password2-confirm" type="password" class="form-control" name="password2_confirmation" placeholder="nhập lại mật khẩu cấp 2"
                required autocomplete="new-password">
        </fieldset>

        <div class="form-group row">
            <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                <fieldset>
                    <input type="checkbox" id="remember" class="chk-remember">
                    <label for="remember"> Ghi nhớ</label>
                </fieldset>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-primary btn-block"><i class="feather icon-user"></i> Đăng ký</button>
    </form>
    <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block mt-2"><i class="feather icon-unlock"></i> Đăng nhập</a>
</div> -->
<form method="POST" action="{{ route('register') }}" class="form-login register-form">
    @csrf    
    <div class="title-form">
        <img src="assets/images/login-title.png">
    </div>
    <div class="form-group input-lock">
        <label>Tên Tài Khoản</label>
        <input id="cAccName" type="text" class="form-control @error('cAccName') is-invalid @enderror" placeholder="Nhập tên tk"
            name="cAccName" value="{{ old('cAccName') }}" required autocomplete="cAccName" autofocus>        
            @error('cAccName')
                <span class="invalid-feedback" role="alert">
                    <strong>Tài khoản đã tồn tại.</strong>
                </span>
            @enderror
    </div>
    <div class="form-group input-lock">
        <label>Mật khẩu</label>        
        <input id="password1" type="password" class="form-control @error('password1') is-invalid @enderror" name="password1" 
            placeholder="mật khẩu cấp 1: 8 ký tự trở lên" required autocomplete="new-password">
            @error('password1')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập mật khẩu cấp 1</strong>
                </span>
            @enderror        
    </div>
    <div class="form-group input-lock">
        <label>Nhập lại mật khẩu</label>        
        <input id="password1-confirm" type="password" class="form-control" name="password1_confirmation" placeholder="Nhập lại mật khẩu cấp 1"
            required autocomplete="new-password">
    </div>

    <div class="form-group input-lock">
        <label>Mật khẩu</label>        
        <input id="password2" type="password" class="form-control @error('password2') is-invalid @enderror" name="password2" 
            placeholder="mật khẩu cấp 2: 8 ký tự trở lên" required autocomplete="new-password">
            @error('password2')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập mật khẩu cấp 2</strong>
                </span>
            @enderror        
    </div>
    <div class="form-group input-lock">
        <label>Nhập lại mật khẩu</label>        
        <input id="password2-confirm" type="password" class="form-control" name="password1_confirmation" placeholder="Nhập lại mật khẩu cấp 2"
            required autocomplete="new-password">
    </div>

    <div class="form-group input-lock input-email">
        <label>Email</label>        
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="Nhập email"
            value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>
    <div class="form-group input-lock input-phone">
        <label>Số điện thoại</label>        
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Nhập sđt"
            value="{{ old('phone') }}" required autocomplete="phone">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>Vui lòng nhập số điện thoại</strong>
                </span>
            @enderror
    </div>
    <div class="form-group text-center mt-15">        
        <button type="submit" style="background: none; border: none; padding: 0;">
            <a href="#"><img src="assets/images/btn-register.png"></a>
        </button>
    </div>
</form>
@endsection
