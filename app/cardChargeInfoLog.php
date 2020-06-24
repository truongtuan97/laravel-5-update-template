<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardChargeInfoLog extends Model
{
    protected $table = 'card_charge_info_logs';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adminAccount', 'userAccount', 'cardType', 'value', 'realValue', 'dateUpdate'
    ];
}
