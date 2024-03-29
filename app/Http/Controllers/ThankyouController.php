<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThankyouController extends Controller
{
    public function thank_you()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('thanks',compact('cartitems'));
    }
}