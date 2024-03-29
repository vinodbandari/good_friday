<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at','Desc')->where('status','0')->orWhere('status','3')->orWhere('status','2')->orWhere('status','3')->orWhere('status','4')->orWhere('status','5')->get();
        $orders_count = Order::where('status','1')->count();
        return view('admin.orders.index',compact('orders','orders_count'));
    }

    public function view($id)
    {
         $orders = Order::orderBy('created_at','Desc')->where('id',$id)->first();
        return view('admin.orders.view',compact('orders'));
    }

    public function updateorder(Request $request,$id)
    {
        $orders = Order::find($id);
        $orders->status = $request->input('order_status');
        $orders->update();
        return redirect('admin/orders')->with('message',"Order Updated Successfully");
    }

    public function orderhistory()
    {
        $orders = Order::where('status','1')->get();
        return view('admin.orders.history',compact('orders'));
    }
}