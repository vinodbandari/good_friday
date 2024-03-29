<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    public $fillable = [
        'user_id',
        'prod_id',
        'prod_qty',
        'cate_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }

    // public function category()
    // {
    //     return DB::table('categories')->get();
    // }

    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }



}
