<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        $featured_products = Product::where('trending','1')->take(15)->get();
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlist','cartitems','featured_products'));
    }

    public function add(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('product_id');
            $cate_id = $request->input('category_id');
            if(Wishlist::where('prod_id',$prod_id)->first()==null)
            {
                if(Product::find($prod_id))
                {
                    $wish = new Wishlist();
                    $wish->prod_id = $prod_id;
                    $wish->cate_id = $cate_id;
                    $wish->user_id = Auth::id();
                    $wish->save();
                    return response()->json(['status' => "Product Added to Wishlist",'statuscode'=>200]);
                }
                else
                {
                    return response()->json(['status'=> "Product doesnot exist"]);
                }
            }
            else{
                return response()->json(['status'=> "Product Already exist"]);
            }

        }
        else
        {
          return response()->json(['status' => "Login to Continue",'statuscode'=>500]);

        }
    }

    public function deleteitem(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $wish = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Item Removed from Wishlist"]);
            }
        }
        else
        {
            return response()->json(['status'=>"Login to Continue"]);
        }
    }


    public function wishlistcount()
    {
        $wishcount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count' => $wishcount]);
    }
}