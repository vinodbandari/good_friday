<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $products = Product::where('status','1')->get();
        $coupons = Coupon::all();
        return view('coupons',compact('products','coupons'));
    }

    public function addcoupon(Request $request)
    {
        $coupons = new Coupon();
        $coupons->offer_name = $request->input('offer_name');
        $coupons->product_id = $request->input('product_id');
        $coupons->coupon_code = $request->input('coupon_code');
        $coupons->coupon_limit = $request->input('coupon_limit');
        $coupons->coupon_type = $request->input('coupon_type');
        $coupons->coupon_price = $request->input('coupon_price');
        $coupons->start_datetime = $request->input('start_datetime');
        $coupons->end_datetime = $request->input('end_datetime');
        $coupons->status = $request->input('status')==TRUE ? '1':'0';
        $coupons->visibility_status = $request->input('visibility_status')==TRUE ? '1':'0';
        $coupons->save();

        return redirect()->back()->with('status',"Coupon Added Successfully");
    }

    public function editcoupon(Request $request)
	{
        //dd($request->input('status'));

		$img = getCategoryDetail($request->input('id'))->image;
		$filename = ($img!=null) ? $img : 'default.jpg';
		 if($request->file('image')!=null)
		 {
        $image = $request->file('image');

		$filename = $request->input('code').'-cat'.'.'.$image->getClientOriginalExtension();
        $input['imagename'] = $filename;
		//unlink($filename);

        $destinationPath = public_path('assets/uploads/category');
		$filepath = $destinationPath."/".$filename;
		if(file_exists($filepath))
		unlink($filepath);
        $img = Image::make($image->getRealPath());
        $img->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
	}
	else{

	}
		try{

			DB::table('coupons')
			->where('id', $request->input('id'))
			->update([
            'offer_name'=>$request->input('offer_name'),
			'product_id'=>Str::slug($request['product_id']),
			'coupon_code'=>$request->input('coupon_code'),
            'coupon_limit' => $request->input('coupon_limit'),
            'coupon_type' => $request->input('coupon_type'),
            'coupon_price' => $request->input('coupon_price'),
            'start_datetime' => $request->input('start_datetime'),
            'end_datetime' => $request->input('end_datetime'),
            'status' => $request->input('status'),
            'visibility_status' => $request->input('visibility_status')== true ? '1':'0',
			]);
			return redirect(url()->previous())->with('message', 'Coupon updated sucessfully');
			}
			catch(Exception $e) {
				return redirect(url()->previous())->with('message', 'Error updating Category');
				}

	}

    public function destroy($id)
    {

        $coupons = Coupon::find($id);

        $coupons->delete();
        return redirect()->back()->with('message',"coupon Deleted Successfully");
    }

}