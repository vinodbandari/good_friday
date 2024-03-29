<?php

namespace App\Http\Controllers\Frontend;

use Str;
use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // $old_cartitems = Cart::where('user_id',Auth::id())->get();
        // foreach($old_cartitems as $item)
        // {
        //     if(!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
        //     {
        //         $removeItem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
        //         $removeItem->delete();
        //     }
        // }

        $cartitems = Cart::where('user_id', Auth::id())->get();


        return view('frontend.checkout', compact('cartitems'));
    }




    public function checkingcoupon(Request $request)
    {
        // dd($request->input('coupon_code'));
      $couponcode = $request->input('coupon_code');

      if(Coupon::where('coupon_code',$couponcode)->exists())
      {
        $coupon = Coupon::where('coupon_code',$couponcode)->first();
        // dd($coupon);
        // if($coupon->start_datetime <= Carbon::today()->format('Y-m-d') && Carbon::today()->format('Y-m-d') <= $coupon->end_datetime)
        if(Coupon::where('status','1'))
        {


                $cartitems_total = Cart::where('user_id',Auth::id())->get();


                $total = 0;

                $shipping = 80;
                $finalamt = 0;
                $cartitems_total = Cart::where('user_id', Auth::id())->get();
                foreach ($cartitems_total as $prod) {
                    $total += $prod->products->selling_price * $prod->prod_qty;
                }


                if($coupon->coupon_type == 1)
                {
                //   $discount_price = ($total/100) * $coupon->coupon_price;
                // dd($discount_price);
                $discount_price = $coupon->coupon_price;

                }
                elseif($coupon->coupon_type == "2")
                {
                    $discount_price = $coupon->coupon_price;
                    // dd($discount_price);
                }

                $grand_total = $total + $shipping - $discount_price;
                // dd($grand_total);

                return response([

                    'discount_price' => $discount_price,
                    'grand_total_price' => $grand_total,
                    'status' => 'Coupon Code Applied Successfully',
                    'error_status' => 'error',
                ]);





        }
        else
        {
            return response()->json([
                'status' => 'Coupon Code has been Expired',
                'error_status' => 'error',
            ]);
        }
      }
      else
      {
        return response()->json([
            'status' => 'Coupon Doesnot Exists',
            'error_status' => 'error',
        ]);
     }
    }

    public function placeorder(Request $request)
    {
        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            'fname' => 'required|string|min:4',
            'lname' => 'required|string|min:4',
            'address1' => 'required|string|min:5',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'country' => 'required',
            'pincode' => 'required|numeric|digits:6',
            'state' => 'required|string|min:4',
        ]);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->company_name = $request->input('company_name');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');

        //To calculate the total price
        $total = 0;

        $shipping = 80;
        $finalamt = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }



        $couponcode = $request->input('coupon_code');

        if (Coupon::where('coupon_code', $couponcode)->exists()) {
            $coupon = Coupon::where('coupon_code', $couponcode)->first();
            $discount  = $coupon->coupon_price;
            $finalamt = $total + $shipping - $discount;
        }
        else
        {
            $finalamt = $total + $shipping;
        }





        $order->total_price = $finalamt;

        $order->tracking_no = 'laxmipriya'.rand(1111, 9999);

        $order->save();
        //dd();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {
            OrderItem::create([
                // these are taken from order model
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price,
            ]);

            // when we added items in carts,the quantity of items will decrease
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }

        if (Auth::user()->address1 == null) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->company_name = $request->input('company_name');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }

        // if (Auth::user()->address1 == null) {
        //     $newuser = Address::where('id', Auth::id())->first();
        //     // $user->fname = $request->input('fname');
        //     // $user->lname = $request->input('lname');
        //     $newuser->phone = $request->input('phone');
        //     // $user->company_name = $request->input('company_name');
        //     $newuser->address1 = $request->input('address1');
        //     $newuser->address2 = $request->input('address2');
        //     $newuser->city = $request->input('city');
        //     $newuser->state = $request->input('state');
        //     $newuser->country = $request->input('country');
        //     $newuser->pincode = $request->input('pincode');
        //     $newuser->update();
        // }













        $cartitems = Cart::where('user_id', Auth::id())->get();
        session(['order_id' => $order->id]);
        $api = \Instamojo\Instamojo::init('app', [
            'client_id' => 'test_GwiZB6cB6uuSK6mRsvm4vjZo9rud45ve0VI',
            'client_secret' => 'test_L1cTLIYaHjH8jLZ2pAuFsDvQgS4cjBDvwPWrfNjryYR9ySOiUcfaGjPyHnADBNVVgLu6U1KtXLAPr3WLxgrjRGaldPrxBdxNNByCCUGyGPU4XbgXmtZ9OYd88Yq',

        ], true);

        try {
            $response = $api->createPaymentRequest([
                'purpose' => 'Laxmi Priya Jewellers Order Id -'.$order->id,
                'amount' => $finalamt.'',
                'buyer_name' => $request->fname.' '.$request->lname,
                'send_email' => true,
                'send_sms' => true,
                'email' => $request->email,
                'phone' => $request->phone,
                'redirect_url' => route('instamojo.success.payment'),
                'webhook' => 'http://www.example.com/webhook/',
            ]);

            header('Location: '.$response['longurl']);
            exit();
        } catch (Exception $e) {
            dd($e);
            throw new Exception($e->getMessage(), 1);
        }

        return redirect('/')->with('status', 'Order placed Successfully');
    }

    // public function handlePayment(Request $request)
    // {

    // $api = new \Instamojo\Instamojo(
    //     'test_GwiZB6cB6uuSK6mRsvm4vjZo9rud45ve0VI',
    //     env('INSTAMOJO_AUTH_TOKEN'),
    //     env('INSTAMOJO_URL')
    // );

    // $api = \Instamojo\Instamojo::init('app', [
    //     'client_id' => 'test_GwiZB6cB6uuSK6mRsvm4vjZo9rud45ve0VI',
    //     'client_secret' => 'test_L1cTLIYaHjH8jLZ2pAuFsDvQgS4cjBDvwPWrfNjryYR9ySOiUcfaGjPyHnADBNVVgLu6U1KtXLAPr3WLxgrjRGaldPrxBdxNNByCCUGyGPU4XbgXmtZ9OYd88Yq',

    // ], true);

    // try {
    //     $response = $api->createPaymentRequest([
    //         'purpose' => 'Laxmi',
    //         'amount' => '50',
    //         'buyer_name' => 'Mahedi Hasan',
    //         'send_email' => true,
    //         'send_sms' => true,
    //         'email' => 'demo@laravelia.com',
    //         'phone' => '9999999999',
    //         'redirect_url' => route('instamojo.success.payment'),
    //         'webhook' => 'http://www.example.com/webhook/',
    //     ]);

    //     header('Location: '.$response['longurl']);
    //     exit();
    // } catch (Exception $e) {
    //     dd($e);
    //     throw new Exception($e->getMessage(), 1);
    // }
    // }

    public function successPayment(Request $request)
    {
        try {
            $api = \Instamojo\Instamojo::init('app', [
                'client_id' => 'test_GwiZB6cB6uuSK6mRsvm4vjZo9rud45ve0VI',
                'client_secret' => 'test_L1cTLIYaHjH8jLZ2pAuFsDvQgS4cjBDvwPWrfNjryYR9ySOiUcfaGjPyHnADBNVVgLu6U1KtXLAPr3WLxgrjRGaldPrxBdxNNByCCUGyGPU4XbgXmtZ9OYd88Yq',

            ], true);
            $response = $api->getPaymentRequestDetails(
                request('payment_request_id')
            );
            // dd($response);
        } catch (\Exception $e) {
            dd($e);
        }

            if ($response['status'] === 'Completed') {
                $orderid = Str::after($response['purpose'], '-');
                $instamojoid = $response['id'];
                $paymentid = $_GET['payment_id'];
                $date = $response['created_at'];
                $finalamount = $response['amount'];
                // dd($response['amount']);
                // dd($instamojoid);

                $payment = new Payment();
                $payment->order_id = $orderid;
                $payment->instamojo_id = $instamojoid;
                $payment->payment_id = $paymentid;
                $payment->paid_on = $date;
                $payment->final_amount = $finalamount;
                $payment->save();

                $cartitems = Cart::where('user_id', Auth::id())->get();
                Cart::destroy($cartitems);
                // return back()->withError('Payment failed');
                // dd('Success');
                return redirect('/thankyou');
            }

            // dd('payment Failed');

        // dd($response);
    }

    public function delete(Request $request)
    {

            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                // return response()->json(['status' => "Products Deleted Successfully"]);
            }

    }



}