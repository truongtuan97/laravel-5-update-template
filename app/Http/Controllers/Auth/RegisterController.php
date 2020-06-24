<?php

namespace App\Http\Controllers\Auth;

use App\AccountInfo;
use App\AccountHabitus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'cAccName' => ['required', 'string', 'max:20', 'unique:account_info'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:account_info'],
            'phone' => ['required', 'numeric', 'min:11'],
            'password1' => ['required', 'string', 'min:8', 'confirmed'],
            'password2' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = AccountInfo::create([
            'cAccName' => $data['cAccName'],
            'cPassWord' => strtoupper(md5($data['password1'])),
            'cSecPassWord' => strtoupper(md5($data['password2'])),            
            'iClientID' => 0,
            'dLoginDate' => Carbon::Now(),
            'dLogoutDate' => Carbon::Now(),
            'dCreatedDate' => Carbon::Now(),
            'nExtPoint' => 1,
            'nExtPoint1' => 0,
            'nExtPoint2' => 0,
            'nExtPoint3' => 0,
            'nExtPoint4' => 0,
            'nExtPoint5' => 0,
            'nExtPoint6' => 0,
            'nExtPoint7' => 0,
            'nUserIP' => 1,
            'nUserIPPort' => 1,
            'nFeeType' => 1,
            'bParentalControl' => 0,
            'bIsBanned' => 0,
            'bIsUseOTP' => 0,
            'iOTPSessionLifeTime' => 1,
            'iServiceFlag' => 0,
            'plainpassword' => $data['password1'],
            'plainpassword2' => $data['password2'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
        AccountHabitus::create([
            'cAccName' => $data['cAccName'],
            'iLeftSecond' => '999999999',
            'dEndDate' => new Carbon('2050-12-31')
        ]);
        return $user;
    }
}