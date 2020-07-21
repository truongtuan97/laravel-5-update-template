<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankHistory extends Model
{
    protected $table = 'bank_histories';
    protected $dateFormat = 'Y-m-d H:i:s';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "username","orderID","baokim_txn_id", "total_amount", "ingame_amount",
        "bank_id","status","success", 'created_at', 'updated_at'
    ];
}
