<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountInfo extends Authenticatable
{
    use Notifiable;
    // protected $connection = 'sqlsrv';
    protected $table = 'account_info';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cAccName','cSecPassWord','cPassWord','iClientID','dLoginDate','dLogoutDate',
        'nExtPoint','nExtPoint1','nExtPoint2','nExtPoint3','nExtPoint4','nExtPoint5','nExtPoint6','nExtPoint7',
        'nUserIP','nUserIPPort','nFeeType','bParentalControl','bIsBanned','bIsUseOTP','iOTPSessionLifeTime','iServiceFlag',
        'plainpassword','plainpassword2','email','phone','role','dCreatedDate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'cPassWord', 'cSecPassWord', 'plainpassword', 'plainpassword2', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
