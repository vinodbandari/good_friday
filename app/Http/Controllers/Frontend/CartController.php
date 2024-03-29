<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{



    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $cate_id = $request->input('cate_id');

        if(Auth::check())
        {
            $prod_check = Product::where('id',$product_id)->first();

            if($prod_check)
            {
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status'=> $prod_check->name."Already added to cart"]);
                }
                else
                {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->cate_id  = $cate_id;
                    $cartItem->save();
                    return response()->json(['status'=> $prod_check->name."Added to cart","statuscode"=>200]);
                }

            }
        }
        else
        {
            return response()->json(['status'=>"Login to Continue", "statuscode"=>500]);
        }
    }



    public function viewcart()
    {
        $featured_products = Product::where('trending','1')->take(15)->get();
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartitems','featured_products'));
    }


    public function deleteproduct(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Products Deleted Successfully"]);
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }

    }

    public function clearcart()
    {
        $items = Cart::all();
        $items->each->delete();
        return redirect()->back();
    }


    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $cart = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status'=> "Quantity updated"]);
            }
        }
    }

    public function updateminicart(Request $request)
    {
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('layouts.laxmi.mini_cart',compact('cartitems'));
    }


    public function cartcount()
    {
        $cartcount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $cartcount]);
    }

    public function wishlistcount()
    {
        $wishcount  = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count' => $wishcount]);
    }


}