<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {

        $category = Category::all();
        $products = Product::orderBy('created_at', 'Desc')->get();
        $prod_count = Product::count();

        return view('product', compact('products', 'category', 'prod_count'));

    }

    public function addproduct(Request $request)
    {
        $request->validate([

            'image' => 'required',

        ]);

        $products = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/', $filename);
            $products->image = $filename;
        }

        $products->cate_id = $request->input('cate_id');
        $products->name = $request->input('name');
        $products->slug = Str::slug($request['slug']);
        // $category->slug = Str::slug($validatedData['slug']);
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->stone_name = $request->input('stone_name');
        $products->weight = $request->input('weight');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->qty = $request->input('qty');
        $products->status = $request->input('status') == true ? '1' : '0';
        // $products->trending = $request->input('trending')==TRUE ? '1':'0';
        $products->trending = $request->input('trending');
        $products->gender = $request->input('gender');
        $products->onsale_products = $request->input('onsale_products') == true ? '1' : '0';
        $products->save();

        return redirect('admin/product')->with('message', 'Product Added Successfully');

    }

    // public function update(Request $request)
    // {

    //     $id = $request->all();
    //   $category = Product::find($id);
    //   if($request->hasFile('image'))
    //   {
    //     $path = 'assets/uploads/category/'.$category->image;
    //     if(File::exists($path))
    //     {
    //         File::delete($path);
    //     }
    //     $file = $request->file('image');
    //     $ext = $file->getClientOriginalExtension();
    //     $filename = time(). '.' .$ext;
    //     $file->move('assets/uploads/category/',$filename);
    //     $category->image = $filename;

    //   }
    //   $category->name = $request->input('name');
    //   $category->slug = $request->input('slug');

    //   $category->description = $request->input('description');
    //   $category->status = $request->input('status')==TRUE ? '1':'0';
    //   $category->popular = $request->input('popular')==TRUE ? '1':'0';
    //   $category->update();
    //   return redirect('category')->with('status',"category updated Successfully");
    // }

    public function editproduct(Request $request)
    {
        // dd($request->all());
        $img1 = getProductDetail($request->input('id'))->image;
        $filename = ($img1 != null) ? $img1 : 'default.jpg';
        if ($request->file('image') != null) {
            $image = $request->file('image');

            $filename = $request->input('code').'-prod'.'.'.$image->getClientOriginalExtension();
            $input['imagename'] = $filename;

            $destinationPath = public_path('assets/uploads/products');
            $filepath = $destinationPath.'/'.$filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $img1 = Image::make($image->getRealPath());
            $img1->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
        } else {

        }
        try {
            $slug = Str::slug($request->name, '-');
            DB::table('products')
                ->where('id', $request->input('id'))
                ->update([
                    'name' => $request->input('name'),
                    // 'slug'=>$request->input('slug'),
                    'slug' => Str::slug($request['slug']),
                    'cate_id' => $request->input('cate_id'),
                    'description' => $request->input('description'),
                    'stone_name' => $request->input('stone_name'),
                    'weight' => $request->input('weight'),
                    'small_description' => $request->input('small_description'),
                    'original_price' => $request->input('original_price'),
                    'selling_price' => $request->input('selling_price'),
                    'qty' => $request->input('qty'),
                    'status' => $request->input('status'),
                    'trending' => $request->input('trending'),
                    'gender' => $request->input('gender'),
                    'onsale_products' => $request->input('onsale_products') == true ? '1' : '0',
                    // 'popular' => $request->input('popular')==TRUE ? '1':'0',
                    'image' => $filename,
                ]);

            return redirect(url()->previous())->with('message', 'Product updated sucessfully');
        } catch (Exception $e) {
            return redirect(url()->previous())->with('message', 'Error updating Product');
        }

    }

    public function destroy($id)
    {
        $products = Product::find($id);

        if ($products->image) {
            $path = 'assets/uploads/products/'.$products->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        } elseif ($products->image1) {
            $path = 'assets/uploads/products/'.$products->image1;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $products->delete();

        return redirect('admin/product')->with('message', 'Product Deleted Successfully');

        // $id = base64_decode($id);
        // $product = Product::find($id);
        // $images = json_decode($product->image);
        // if (is_array($images) || is_object($images))
        // {
        //     foreach($images as $file)
        //     {
        //         unlink(public_path('assets/uploads/products/').$file);
        //     }
        // }

        // $product->delete();
        // return redirect('product')->with('message','Product Deleted Successfully');
    }

    public function addAttribute($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            foreach ($data['sku'] as $key => $value) {
                if (! empty($value)) {

                    $attrCountSKU = ProductAttribute::where('sku', $value)->count();
                    if ($attrCountSKU > 0) {
                        $message = 'SKU already exists,Please add another SKU';
                        Session::flash('error_message', $message);

                        return redirect()->back();
                    }
                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
        }

        $productdata = Product::select('id', 'name', 'description', 'image')->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata), true);

        // echo "<pre>"; print_r($productdata);die;
        return view('add_attributes', compact('productdata'));
    }

    // public function detail($id)
    // {
    //     $productDetails = Product::find($id)->toArray();
    //     dd($productDetails);die;
    //     return view('products.detail');
    // }

    public function editAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['attrId'] as $key => $attr) {
                if (! empty($attr)) {
                    ProductAttribute::where(['id' => $data['attrId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }

            $message = 'Product attributes has been updated successfully';
            Session::flash('success_message', $message);

            return redirect()->back();
        }
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function deleteAttribute($id)
    {
        ProductAttribute::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Product Attribute has been deleted successfully');
    }

    public function live_stock(Request $request)
    {
        $id = $request->prod_id;
        $product = Product::find($id);

        return $product->qty;

    }

    public function export()
    {
        $filename = "product.xlsx";
        return Excel::download(new ProductExport, $filename);
    }
}