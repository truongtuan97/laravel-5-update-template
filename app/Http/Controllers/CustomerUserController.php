<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\AccountInfo;
use App\CardChargeInfoLog;
use App\AccountMoneyTracking;
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