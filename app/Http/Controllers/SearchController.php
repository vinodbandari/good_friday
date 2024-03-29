<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {

       // return $request->input();

       $category = Category::where('status','1')->get();
       // $products = Product::where('status','1')->get();


       $categories = Category::where('status','1')->take(15)->get();
       $cartitems = Cart::where('user_id',Auth::id())->get();
       $featured_products = Product::where('trending','1')
        ->take(15)->get();
       //return $request->input();
       // return $data = Product::where('name','like','%'.$request->input('query').'%')->get();

       $data = Product::where('name','like','%'.$request->input('query').'%')->paginate(12);

       return view('frontend.loadmore',['products'=>$data,'categories'=>$categories,'cartitems'=>$cartitems,'featured_products'=>$featured_products,'category'=>$category]);
    }
}