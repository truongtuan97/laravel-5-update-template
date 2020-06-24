<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountMoneyTracking extends Model
{
    protected $connection = 'sqlsrv2';
    protected $table = 'Account_MoneyTracking';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'AccountName', 'OldMoney', 'NewMoney', 'SubtractMoney', 'DateUpdate'
    ];
}
