<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BaoKimSDK\BaoKim;

use App\Customer;
use App\AccountInfo;
use App\CardChargeInfoLog;
use App\AccountMoneyTracking;
use App\CardInfo;
use App\CardType;
use App\CardHistory;
use App\BankHistory;
use App\PromotionConfiguration;

use Carbon\Carbon;

class CustomerUserController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('auth');
    }

    public function show() {
        $user = Auth::user();
        $user->email = $this->displayEmail($user->email);
        $user->phone = $this->displayPhone($user->phone);
        return view('users.show', compact('user'));
    }

    public function edit(AccountInfo $user) {
        $user = Auth::user();
        $customer = Customer::where('username', $user->cAccName)->first();
        if (!isset($customer))
        {
            $customer = new Customer();
        }
        return view('users.edit', compact('user', 'customer'));
    }

    public function update() {
        $this->validate(request(), [
            'hoten' => 'required|string|max:255',                        
            'ngaysinh' => ['nullable', 'date'],
            'sdtzalo' => ['nullable', 'numeric'],
            'linkfacebook' => ['nullable', 'string', 'max:255']
        ]);
        
        $user = auth()->user();
        $customer = Customer::where('username', $user->cAccName)->first();

        if (!isset($customer)) {            
            $customer = new Customer();
            $customer->username = $user->cAccName;
        } 
        
        $customer->hoten = request('hoten');
        
        if (request('cmnd'))
            $customer->cmnd = request('cmnd');
        
        if (request('ngaysinh'))
            $customer->ngaysinh = request('ngaysinh');

        if (request('sdtzalo'))
            $customer->sdtzalo = request('sdtzalo');

        if (request('linkfacebook'))
            $customer->linkfacebook = request('linkfacebook');

        $customer->save();
        
        return redirect('/home');
    }

    public function lichsunaptien() {
        $user = auth()->user();
        $userCardChargeLogs = CardChargeInfoLog::where('userAccount', $user->cAccName)->get();
        return view('users.lichsunaptien', compact('userCardChargeLogs'));
    }

    public function lichsuruttien() {
        $user = auth()->user();
        $accMoneyTracking = new AccountMoneyTracking;
        $accMoneyTracking->setConnection('sqlsrv2');

        $userMoneyTakenLogs = $accMoneyTracking->where('AccountName', $user->cAccName)->get();

        return view('users.lichsuruttien', compact('userMoneyTakenLogs'));
    }

    public function editPwdC1() {
        $user = Auth::user();        
        return view('users.editPwdC1', compact('user'));
    }

    public function updatePwdC1(){
        $this->validate(request(), [            
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password2' => ['required', 'string', 'min:8'],            
        ]);
        $user = auth()->user();
        
        if ($user->cSecPassWord == strtoupper(md5(request('password2')))) {
            $user->cPassword = strtoupper(md5(request('password')));
            $user->plainpassword = request('password');
            $user->save();
            return redirect()->back()->with('alert', 'success');
        }
        else {
            return redirect()->back()->withErrors(['password2' => ['Mật khẩu cấp 2 không đúng']]);
        }
    }

    public function editPwdC2() {
        $user = Auth::user();        
        return view('users.editPwdC2', compact('user'));
    }

    public function updatePwdC2(){
        $this->validate(request(), [
            'email' => 'nullable|max:255|email',
            'phone' => ['nullable', 'numeric', 'min:11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        
        if ($user->email == request('email') && $user->phone == request('phone')) {
            $user->cSecPassword = strtoupper(md5(request('password')));
            $user->plainpassword2 = request('password');
            $user->save();
            return redirect()->back()->with('alert', 'success');
        }
        else {
            if ($user->email != request('email'))
                return redirect()->back()->withErrors(['email' => ['Nhập lại email.']]);
            
            if ($user->phone != request('phone'))
                return redirect()->back()->withErrors(['phone' => ['Nhập lại số điện thoại.']]);
        }
    }

    public function editEmail() {
        $user = Auth::user();        
        return view('users.editEmail', compact('user'));
    }

    public function updateEmail(){
        $this->validate(request(), [
            'email' => 'required|max:255|email',
            'phone' => ['nullable', 'numeric', 'min:11'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $user = auth()->user();
                
        if ($user->phone == request('phone') && $user->cSecPassWord == strtoupper(md5(request('password')))) {
            $user->email = request('email');            
            $user->save();
            return redirect()->back()->with('alert', 'success');
        }
        else {
            if ($user->cSecPassWord != strtoupper(md5(request('password'))))
                return redirect()->back()->withErrors(['password' => ['Nhập lại password.']]);
            
            if ($user->phone != request('phone'))
                return redirect()->back()->withErrors(['phone' => ['Nhập lại số điện thoại.']]);
        }
    }

    public function editPhone() {
        $user = Auth::user();        
        return view('users.editPhone', compact('user'));
    }

    public function updatePhone(){
        $this->validate(request(), [
            'email' => 'nullable|max:255|email',
            'phone' => ['required', 'numeric', 'min:11'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = auth()->user();
        
        if ($user->email == request('email') && $user->cSecPassWord == strtoupper(md5(request('password')))) {
            $user->phone = request('phone');            
            $user->save();
            return redirect()->back()->with('alert', 'success');
        }
        else {            
            if ($user->cSecPassWord != strtoupper(md5(request('password'))))
                return redirect()->back()->withErrors(['password' => ['Nhập lại password.']]);
            
            if ($user->email != request('email'))
                return redirect()->back()->withErrors(['email' => ['Nhập lại email.']]);               
        }
    }

    public function thanhtoan() {        
        BaoKim::setKey(env("BAOKIM_API_KEY"), env("BAOKIM_SECREY_KEY"));
                
        $url_api = "https://api.baokim.vn/payment/api/v4/bpm/list?jwt=".BaoKim::getKey()."&lb_available=0&offset=0&limit=100";
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HTTPHEADER     => array("Content-Type: application/json", "Accept: application/json"),  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed            
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 60,    // time-out on connect
            CURLOPT_TIMEOUT        => 60,    // time-out on response
            CURLOPT_POST           => false,                        
            CURLOPT_SSL_VERIFYPEER => false,  // ignore SSL verify            
        );
        
        // create request with CURL
        $ch = curl_init($url_api);
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
                
        $data = json_decode($response);

        curl_close($ch);

        //dd($data);
        $bankList = [];
        $dataViBaoKim = null;
        $dataQRCode = null;
        foreach ($data->data as $dataItem) {
            if ($dataItem->type == 1) {
                $bankList[] = $dataItem;
            }
            if ($dataItem->type == 0) {
                $dataViBaoKim = $dataItem;
            }
            if ($dataItem->type == 14) {
                $dataQRCode = $dataItem;
            }
        }

        $user = Auth::user();
        $cardInfos = CardInfo::all();

        return view('users.thanhtoan', compact([ 'user', 'data', 'cardInfos', 'bankList', 'dataViBaoKim', 'dataQRCode' ]));
    }

    public function updateThanhToan(Request $request) {
        $validateResult = $this->validate($request, [
            //'QRCode' => 'required',
            'cardInfo' => 'required',
            //'bankID' => 'required'
        ]);
        $user = Auth::user();
        $chkm = PromotionConfiguration::all()->first();
        
        $date = new \DateTime();
        
        $orderID = $user->cAccName.'-'.$date->getTimestamp();
        $cardAmount = $request->cardInfo;
                                                    
        BaoKim::setKey(env("BAOKIM_API_KEY"), env("BAOKIM_SECREY_KEY"));
        $url_api = "https://api.baokim.vn/payment/api/v4/order/send?jwt=".BaoKim::getToken();
        
        //BaoKim::setKey("a18ff78e7a9e44f38de372e093d87ca1", "9623ac03057e433f95d86cf4f3bef5cc");
        //$url_api = "https://sandbox-api.baokim.vn/payment/"."api/v4/order/send?jwt=".BaoKim::getToken();
        $bmp_id = $request->bankID;
        if ($request->QRCode == true) {
            $bmp_id = 297;
        }
        $payload['mrc_order_id']    = $orderID;
        $payload['total_amount']    = $cardAmount;
        $payload['description']     = "Test thanh toan pro";
        $payload['url_success']     = env("NAPCARD_WEB_HOOK_URL");
        //$payload['merchant_id']     = 13;
        $payload['url_detail']      = env("NAPCARD_WEB_HOOK_URL");
        $payload['lang']            = "en";
        $payload['bpm_id']          = $bmp_id;
        $payload['accept_bank']     = 1;
        $payload['accept_cc']       = 1;
        $payload['accept_qrpay']    = 1;
        $payload['accept_e_wallet'] = 0;
        $payload['webhooks']        = env("NAPCARD_WEB_HOOK_URL");
        $payload['customer_email']  = $user->email;
        $payload['customer_phone']  = $user->phone;
        $payload['customer_name']   = $user->cAccName;
        //$payload['customer_address'] = $user->address;        
        
        // create request with CURL
        $ch = curl_init($url_api);

        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HTTPHEADER     => array("Content-Type: application/json", "Accept: application/json"),  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed            
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 60,    // time-out on connect
            CURLOPT_TIMEOUT        => 60,    // time-out on response
            CURLOPT_POST           => true,                        
            CURLOPT_SSL_VERIFYPEER => false,  // ignore SSL verify
            CURLOPT_POSTFIELDS     => \json_encode($payload)
        ); 

        curl_setopt_array($ch, $options);        
        $output = curl_exec($ch);
        curl_close($ch);

        //save to log
        BankHistory::create([
            'username' => Auth::user()->cAccName,
            'orderID' => $orderID,            
            'total_amount' => $cardAmount,
            'status' => 1,
            'ingame_amount' => (($cardAmount / 1000) + (($cardAmount / 1000) * $chkm->khuyenmai)),
            'bank_id' => $request->bankID,
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

        dd(\json_decode($output));
    }

    public function napcard() {
        $user = Auth::user();
        $cardInfos = CardInfo::all();
        $cardTypes = CardType::all();
        return view('users.napcard', compact(['user', 'cardInfos', 'cardTypes']));
    }
    
    public function updateNapCard(Request $request) {

        $validateResult = $this->validate($request, [
            'cardType' => 'required',
            'cardInfo' => 'required',
        ]);        
        $user = Auth::user();
        $chkm = PromotionConfiguration::all()->first();
        
        $date = new \DateTime();
        
        $orderID = $user->cAccName.'-'.$date->getTimestamp();        
        $cardAmount = $request->cardInfo;
        
        $payload['mrc_order_id'] = $orderID;
        $payload['telco'] = $request->cardType;
        $payload['amount'] = $cardAmount;
        $payload['code'] = $request->pin;
        $payload['serial'] = $request->serial;
        $payload['webhooks'] = env("NAPCARD_WEB_HOOK_URL");
        
        BaoKim::setKey(env("BAOKIM_API_KEY"), env("BAOKIM_SECREY_KEY"));
        $url_api = "https://api.kingcard.online/kingcard/api/v1/strike-card?jwt=".BaoKim::getKey();        
        
        //save to log
        CardHistory::create([
            'username' => Auth::user()->cAccName,
            'orderID' => $orderID,
            'card_type' => $request->cardType,
            'card_amount' => $request->cardInfo,
            'card_code' => $request->pin,
            'card_serial' => $request->serial,
            'status' => 1,
            'ingame_amount' => (($cardAmount / 1000) + (($cardAmount / 1000) * $chkm->khuyenmai)),
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        
        // create request with CURL
        $ch = curl_init($url_api);

        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HTTPHEADER     => array("Content-Type: application/json", "Accept: application/json"),  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed            
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 60,    // time-out on connect
            CURLOPT_TIMEOUT        => 60,    // time-out on response
            CURLOPT_POST           => true,                        
            CURLOPT_SSL_VERIFYPEER => false,  // ignore SSL verify
            CURLOPT_POSTFIELDS     => \json_encode($payload)
        ); 
            
        curl_setopt_array($ch, $options);        
        $output = curl_exec($ch);
        curl_close($ch);
        
        $loop = 0;
        $cardHistory = new \stdClass();
        
        while ($loop < 3) {
            \sleep(env('SECOND_TIMEOUT'));
            $cardHistory = CardHistory::where('orderID', $orderID)->first();
            if ($cardHistory->success == 1) {
                break;
            }
            $loop += 1;
        }
                
        if ($cardHistory->success == 1) {
            return redirect()->back()->with('alert', 'success');
        } else {
            if ($cardHistory->status == 1) {
                return redirect()->back()->with('alert', 'status1');
            }
            if ($cardHistory->status == 3) {
                return redirect()->back()->with('alert', 'status2');
            }
            if ($cardHistory->status == 3) {
                return redirect()->back()->with('alert', 'status3');
            }
        }
    }

    private function displayEmail($email) {
        $pieces = explode("@", $email);
        $firstString = $pieces[0];
        $secondString = $pieces[1];
        $firstString = str_replace(substr($firstString, 3), '***', $firstString);

        return $firstString.'@'.$secondString;
    }

    private function displayPhone($phone) {
        $str1 = substr($phone, 0, 3);
        $str2 = substr($phone, -3);
        $phone = $str1.'****'.$str2;
        return $phone;
    }
}