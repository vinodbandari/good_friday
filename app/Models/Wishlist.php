<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';
    protected $fillable = [
        'user_id',
        'prod_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
}