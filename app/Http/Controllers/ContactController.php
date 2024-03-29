<?php

namespace App\Http\Controllers;

use validate;
use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact()
    {
      $cartitems = Cart::where('user_id',Auth::id())->get();
      return view('frontend.contactme',compact('cartitems'));
    }



    public function sendmessage(Request $request)
    {
        $request->validate([
            'firstname'=> 'required',
            'lastname' => 'required',
            'number' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->firstname = $request->input('firstname');
        $contact->lastname = $request->input('lastname');
        $contact->number = $request->input('number');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');

        $contact->save();
        return redirect()->back()->with('flash',"Message has been send to the Admin");
    }
}
