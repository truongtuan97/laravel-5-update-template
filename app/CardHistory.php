<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardHistory extends Model
{
    protected $table = 'card_history';
    protected $dateFormat = 'Y-m-d H:i:s';
    //public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "username","orderID","baokim_txn_id","card_type","card_code","card_serial","card_amount","card_real_amount",
        "card_fee_amount","status","ingame_amount","success","id"
    ];
}
