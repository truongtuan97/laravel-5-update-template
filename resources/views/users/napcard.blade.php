@extends('layouts.user')

@section('content')
<div id="user-info">
  <div class="container">
      <div class="wrap-user-info">
          <h3 class="title-vl"><span>Nạp Card</span></h3>
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
              <form method="post" action="{{route('user.napcard.update', $user)}}">
                @csrf
                <!-- {{ method_field('PATCH') }} -->

                <div class="form-group row">                                        
                    <label for="cardType" class="col-md-4 col-form-label">{{ __('Loại thẻ') }}</label>
                    <div class="col-sm-6">
                        <select id="cardType" name="cardType" class="form-control" require>
                            <option value="" selected="" disabled="">Chọn loại thẻ</option>
                            @foreach($cardTypes as $cardType)
                            <option value="{{ $cardType->value }}">{{ $cardType->option }}</option>
                            @endforeach
                        </select>  
                        @error('cardType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>                    
                </div>
                <div class="form-group row">                                                            
                    <label for="cardInfo" class="col-md-4 col-form-label">{{ __('Số tiền') }}</label>
                    <div class="col-sm-6">
                        <select id="cardInfo" name="cardInfo" class="form-control" require>
                            <option value="" selected="" disabled="">Chọn giá trị thẻ nạp</option>
                            @foreach($cardInfos as $cardInfo)
                            <option value="{{ $cardInfo->value }}">{{ $cardInfo->option }}</option>
                            @endforeach
                        </select>  
                        @error('cardInfo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="pin" class="col-md-4 col-form-label">PIN</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                        <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" required>

                        @error('pin')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">                    
                    <label for="serial" class="col-md-4 col-form-label">Serial</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                        <input id="serial" type="text" class="form-control @error('serial') is-invalid @enderror" name="serial" required>

                        @error('serial')
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