<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PromotionConfiguration extends Model
{
    use Notifiable;

    protected $table = 'promotion_configurations';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ngay_bat_dau','ngay_ket_thuc','khuyenmai'
    ];
}
