<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $table = 'card_type';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','value','option'
    ];
}
