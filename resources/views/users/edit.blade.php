@extends('layouts.user')

@section('content')
<div id="user-info">
  <div class="container">
      <div class="wrap-user-info">
          <h3 class="title-vl"><span>Cập nhật thông tin cá nhân</span></h3>

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

              <form method="post" action="{{route('users.update', $customer)}}">
                @csrf
                {{ method_field('PATCH') }}

                <div class="form-group row">                                        
                    <label for="hoten" class="col-md-4 col-form-label">{{ __('Họ và tên') }}</label>
                    <div class="col-sm-6">
                      <input id="hoten" type="text" class="form-control @error('hoten') is-invalid @enderror" name="hoten"
                        value="{{ $customer->hoten }}" required>

                      @error('hoten')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>                    
                </div>
                <div class="form-group row">                                                            
                    <label for="cmnd" class="col-md-4 col-form-label">{{ __('Chứng minh nhân dân') }}</label>
                    <div class="col-sm-6">
                      <input id="cmnd" type="text" class="form-control @error('cmnd') is-invalid @enderror" name="cmnd"
                        value="{{ $customer->cmnd }}" required>

                      @error('cmnd')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="ngaysinh" class="col-md-4 col-form-label">Ngày tháng năm sinh</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                      <input id="ngaysinh" type="text" class="form-control @error('ngaysinh') is-invalid @enderror"
                        name="ngaysinh" value="{{ $customer->ngaysinh }}">

                      @error('ngaysinh')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="sdtzalo" class="col-md-4 col-form-label">Số điện thoại zalo</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                      <input id="sdtzalo" type="text" class="form-control @error('sdtzalo') is-invalid @enderror"
                        name="sdtzalo" value="{{ $customer->sdtzalo }}">

                      @error('sdtzalo')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="linkfacebook" class="col-md-4 col-form-label">Link facebook</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                      <input id="linkfacebook" type="text" class="form-control @error('linkfacebook') is-invalid @enderror"
                        name="linkfacebook" value="{{ $customer->linkfacebook }}">

                      @error('linkfacebook')
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