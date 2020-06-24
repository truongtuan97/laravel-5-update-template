@extends('layouts.user')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Update information') }}</div>

        <div class="card-body">
          <form method="post" action="{{route('users.update', $customer)}}">
            @csrf
            {{ method_field('PATCH') }}

            <div class="form-group row">
              <label for="hoten" class="col-md-4 col-form-label text-md-right">{{ __('Họ và tên') }}</label>

              <div class="col-md-6">
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
              <label for="cmnd" class="col-md-4 col-form-label text-md-right">{{ __('Chứng minh nhân dân') }}</label>

              <div class="col-md-6">
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
              <label for="ngaysinh"
                class="col-md-4 col-form-label text-md-right">{{ __('Ngày tháng năm sinh') }}</label>

              <div class="col-md-6">
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
              <label for="sdtzalo" class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại zalo') }}</label>

              <div class="col-md-6">
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
              <label for="linkfacebook" class="col-md-4 col-form-label text-md-right">{{ __('Link facebook') }}</label>

              <div class="col-md-6">
                <input id="linkfacebook" type="text" class="form-control @error('linkfacebook') is-invalid @enderror"
                  name="linkfacebook" value="{{ $customer->linkfacebook }}">

                @error('linkfacebook')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Update') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection