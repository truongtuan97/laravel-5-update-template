<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountInfoLog extends Model
{
    protected $table = 'account_info_logs';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adminAccount', 'userAccount', 'dateUpdate'
    ];
}
