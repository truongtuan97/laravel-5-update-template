<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Customer  extends Model
{
    use Notifiable;

    protected $table = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'hoten', 'ngaysinh', 'sdtzalo', 'linkfacebook', 'cmnd'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
}