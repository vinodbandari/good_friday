<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {

        $address = Address::all();
        $users = DB::table('users')->get();
        $orders = Order::orderBy('created_at', 'Desc')->where('user_id', Auth::id())->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.orders', compact('orders', 'users', 'cartitems', 'address'));
    }

    public function view($id)
    {

        $users = User::where('id', Auth::id())->get();
        $new_address_count = Address::where('user_id', Auth::id())->count();
        $address = Address::where('default', '1')
            ->where('user_id', Auth::id())
            ->get();
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.ordersview', compact('orders', 'cartitems', 'address', 'new_address_count', 'users'));
    }

    public function new_address_index()
    {
        $new_address_count = Address::where('user_id', Auth::id())->count();
        // $users = DB::table('users')->get();
        $users = User::where('id', Auth::id())->get();
        $orders = Order::where('user_id', Auth::id())->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $new_address = Address::where('user_id', Auth::id())->get();

        return view('new_address_view', compact('users', 'orders', 'cartitems', 'new_address', 'new_address_count'));
    }

    public function new_address()
    {

        $users = DB::table('users')->get();
        $orders = Order::where('user_id', Auth::id())->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('new_address', compact('users', 'orders', 'cartitems'));
    }

    public function storeaddress(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->Address()->Create(
            [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
            ]
        );

        return redirect('viewnewaddress')->with('message', 'New Address Saved');
    }

    public function edit_new_address($address_id)
    {
        //dd($address_id);
        $orders = Order::where('user_id', Auth::id())->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $user = address::where('user_id', Auth::id())->findOrFail($address_id);

        return view('edit_newaddress', compact('user', 'address_id', 'orders', 'cartitems'));
    }

    public function destroy($new_address)
    {
        // dd($new_address);
        $new_address = Address::where('user_id', Auth::id())->find($new_address)->delete();

        return redirect('viewnewaddress')->with('message', 'Address Deleted');

    }

    public function default($id)
    {

        // dd($id);
        $address = Address::where('user_id', Auth::id())->get();
        // dd($address->default);
        foreach ($address as $add) {
            if ($add->id == $id) {
                $add->update(['default' => 1]);
            } else {
                $add->update(['default' => 0]);
            }
        }

        return redirect()->back()->with('message', 'Address Set to default successfully');
    }

    public function update_new_address(Request $request)
    {
        $user = address::findOrFail($request->id);

        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->update();

        // $user->update(
        //     [
        //         'new_address' => $request->new_address,
        //         'new_phone'   => $request->new_phone,
        //         'new_city'    => $request->new_city,
        //         'new_state'   => $request->new_state,
        //         'new_country' => $request->new_country,
        //         'new_pincode' => $request->new_pincode,
        //     ]
        // );

        return redirect('viewnewaddress')->with('message', 'Address Updated Successfully');
    }
}
