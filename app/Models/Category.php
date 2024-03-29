<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'popular',
        'image',


    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
