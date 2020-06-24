@extends('layouts.user')

@section('content')
<div id="user-info">
  <div class="container">
      <div class="wrap-user-info">
          <h3 class="title-vl"><span>Đổi mật khẩu cấp 1</span></h3>                                
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
              <form method="post" action="{{route('password_c1.users.update', $user)}}">
                @csrf
                {{ method_field('PATCH') }}

                <div class="form-group row">                                        
                    <label for="password" class="col-md-4 col-form-label">{{ __('Mật khẩu mới') }}</label>
                    <div class="col-sm-8 input-icon input-email">                        
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="new-password" placeholder="mật khẩu cấp 1: 8 ký tự trở lên" required>

                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>                    
                </div>
                <div class="form-group row">                                                            
                    <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Nhập lại mật khẩu mới') }}</label>
                    <div class="col-sm-8 input-icon input-email">                        
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="password" class="col-md-4 col-form-label">Mật khẩu cấp 2</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                          name="password" autocomplete="new-password" required placeholder="Nhập mật khẩu cấp 2">

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