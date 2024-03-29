<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
       'order_id',
       'instamojo_id',
       'payment_id',
       'paid_on',
       'final_amount',
    ];





    public function products()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
