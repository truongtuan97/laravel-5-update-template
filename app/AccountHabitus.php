<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountHabitus extends Model
{
    protected $table = 'account_Habitus';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cAccName','iLeftSecond','dEndDate'
    ];
}
