<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
      'offer_name',
      'product_id',
      'coupon_code',
      'coupon_limit',
      'coupon_type',
      'coupon_price',
      'start_datetime',
      'end_datetime',
      'status',
      'visibility_status',
    ];
}