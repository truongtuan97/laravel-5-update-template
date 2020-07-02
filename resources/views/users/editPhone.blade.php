@extends('layouts.user')

@section('content')
<div id="user-info">
  <div class="container">
      <div class="wrap-user-info">
          <h3 class="title-vl"><span>ĐỔI SỐ ĐIỆN THOẠI</span></h3>                                
          <div class="form-deposit">
            <div class="frm-left fix-width">
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
              <form method="post" action="{{route('phone.users.update', $user)}}">
                @csrf
                {{ method_field('PATCH') }}

                <div class="form-group row">                    
                    <label for="phone" class="col-md-4 col-form-label">{{ __('Nhập số điện thoại') }}</label>

                    <div class="col-sm-8 input-icon input-email">                        
                        <input id="email" type="email" class="form-control @error('password') is-invalid @enderror" name="email"
                          required placeholder="Nhập email hiện tại">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>                    
                </div>
                <div class="form-group row">                                        
                    <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>
                    <div class="col-sm-8 input-icon input-email">                        
                      <input id="email" type="email" class="form-control @error('password') is-invalid @enderror"
                        name="email">

                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="password" class="col-md-4 col-form-label">Mật khẩu cấp 2</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                          name="password" autocomplete="new-password" required placeholder="Nhập mật khẩu">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">                        
                        <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-primary btn-cancel">Hủy</a>
                        <button type="submit" class="btn btn-primary">
                          {{ __('Cập nhật') }}
                        </button>
                    </div>
                </div>
              </form>
            </div><!--frm-left-->
          </div>
      </div><!--wrap-user-info-->
  </div>
</div>
@endsection