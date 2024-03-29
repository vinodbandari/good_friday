<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminContactController extends Controller
{
    public function viewcontacts()
    {
        $cartitems = Cart::where('user_id',Auth::id())->get();
         $contacts = Contact::orderBy('created_at','Desc')->get();
        return view('frontend.admin_contact',compact('cartitems','contacts'));
    }
}
