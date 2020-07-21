@extends('layouts.user')

@section('content')
<div id="user-info">
  <div class="container">
      <div class="wrap-user-info">
          <h3 class="title-vl"><span>THANH TOÁN ĐƠN HÀNG QUA BẢO KIM</span></h3>
          <div class="form-deposit">
            <div class="frm-left fix-width">
              @if (session('alert'))
                @if (session('alert') == 'success')
                <div class="alert alert-success mb-2" role="alert">
                  Update success.
                </div>
                @endif
                @if (session('alert') == 'status1')
                <div class="alert alert-danger mb-2" role="alert">
                  <strong>Thẻ vừa nạp, vui lòng chờ 15 phút rồi kiểm tra lịch sử nạp thẻ.</strong>
                </div>
                @endif
                @if (session('alert') == 'status2')
                <div class="alert alert-danger mb-2" role="alert">
                  <strong>Thẻ lỗi, vui lòng kiểm tra lại mã PIN hoặc Serial.</strong>
                </div>
                @endif
                @if (session('alert') == 'status3')
                <div class="alert alert-danger mb-2" role="alert">
                  <strong>Quá trình nạp card đang được xử lý, vui lòng kiểm tra lịch sử nạp card, hoặc liên hệ với fanpage nếu sau 30 phút chưa nhận được tiền.</strong>
                </div>
                @endif
              @endif
              <form method="post" action="{{route('user.thanhtoan')}}">
                @csrf
                <!-- {{ method_field('PATCH') }} -->
                <div class="form-group row">
                    <label for="cardType" class="col-md-4 col-form-label">{{ __('Thông tin đơn hàng') }}</label>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pin" class="col-md-4 col-form-label">Mã đơn hàng</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                        <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" disabled value="order_bkim1595134638">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pin" class="col-md-4 col-form-label">Mô tả</label>

                    <div class="col-sm-8 input-icon input-pass">                        
                        <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" disabled value="Mô tả đơn hàng">
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

                <!-- <div class="form-group row">                                                            
                    <label for="cardInfo" class="col-md-4 col-form-label">{{ __('Sử dụng ví Bảo Kim') }}</label>
                    <div class="col-sm-6">
                        <input class="form-check-input" type="checkbox" id="chkViBaoKim" value="{{ $dataViBaoKim->id }}" onClick="setCheckedViBaoKim();">
                    </div>
                </div> -->

                <div class="form-group row">                                                            
                    <label for="cardInfo" class="col-md-4 col-form-label">{{ __('Sử dụng QR code') }}</label>
                    <div class="col-sm-6">
                      <input type="hidden" id="QRCode" name="QRCode" value="" />
                      <input class="form-check-input" type="checkbox" id="chkQRCode" value="{{ $dataQRCode->id }}" onClick="setCheckQRCode();">
                    </div>
                </div>

                <div class="form-group row">                                                            
                    <label for="cardInfo" class="col-md-4 col-form-label">{{ __('Sử dụng thẻ ATM nội địa') }}</label>
                    <div class="col-sm-6">
                      <div class="bank_list">
                        <ul id="b_l">
                          <input type="hidden" id="bankID" name="bankID" value="" />
                          @foreach ($bankList as $bank)
                          <li>
                            <img class="img-bank" id="{{ $bank->id}}" style="width: 100%" src="{{ $bank->bank_logo }}" onClick="setActiveBankSelect(this)">
                            <input type="hidden" name="bank_payment_method_id" id="{{ $bank->id}}" value="{{ $bank->id }}">
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">                        
                        <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-primary btn-cancel">Hủy</a>
                        <button type="submit" class="btn btn-primary" onclick="showModal();">
                          {{ __('Thanh toán') }}
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