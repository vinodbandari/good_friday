<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'company_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'total_price',
        'status',
        'message',
        'tracking_no',

    ];

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class);//order has many items in the orderitems table
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);//order has many items in the orderitems table
    }



}