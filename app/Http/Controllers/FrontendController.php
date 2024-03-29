<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
//  use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {

        $prod = new Product();
        $products = Product::all();
        $categories = Category::all();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $onsale_products = Product::where('onsale_products', '1')->take(4)->get();
        $category = Category::where('status', '1')->get();
        $trending_products = Product::where('trending', '1')
            ->paginate(8);
        $mini_featured1 = Product::where('trending', '2')
            ->take(4)->get();
        $mini_featured2 = Product::where('trending', '0')->take(4)->get();
        $popular_category = Category::where('popular', '1')->take(4)->get();

        return view('voilahome', compact('prod', 'cartitems', 'category', 'categories', 'cartitems', 'onsale_products', 'trending_products', 'mini_featured1', 'mini_featured2', 'popular_category'));
    }

    public function about()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.about', compact('cartitems'));
    }

    public function privacy()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.privacy_policy', compact('cartitems'));
    }

    public function termsandconditions()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.terms_conditions', compact('cartitems'));
    }

    public function loadmore(Request $request)
    {
        $sortcolumn = '';
        $sorttype = '';
        $value = '';
        if (isset($request->sort_by)) {
            if ($request->sort_by === 'lowest_price') {
                $sortcolumn = 'selling_price';
                $sorttype = 'asc';
            }
            if ($request->sort_by === 'highest_price') {
                $sortcolumn = 'selling_price';
                $sorttype = 'desc';
            }
        }
        if ($request->gend_by === 'male') {

            $value = '1';
        }
        if ($request->gend_by === 'female') {
            $value = '0';
        }
        $products = Product::query();

        if (isset($request->gend_by)) {

            $products = $products->where('gender', $value);

        }

        if (isset($request->start_price) || isset($request->end_price)) {
            $products = $products->whereBetween('selling_price', [$request->start_price, $request->end_price]);
        }

        if (isset($request->sort_by)) {
            $products = $products->orderBy($sortcolumn, $sorttype);

        }

        $products = $products->paginate(6);
        //dd($request->all());
        //$products = Product::where('status', '1')->orderBy('created_at', 'desc')->paginate(6);
        $category = Category::where('status', '1')->get();
        $categories = Category::where('status', '1')->take(15)->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $featured_products = Product::where('trending', '1')
            ->take(15)->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();

        // $start_price = $request->start_price ??

        // if (isset($request->start_price) || isset($request->end_price)) {
        //     $products = $products->whereBetween('selling_price', [$request->start_price, $request->end_price]);
        //     $products->paginate(6);
        // }

        return view('frontend.loadmore', compact('category', 'products', 'featured_products', 'cartitems', 'categories'));
    }

    public function sort_by(Request $request)
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();

        if ($request->sort_by == 'Lowest_price') {
            $products = Product::orderBy('selling_price', 'asc')->paginate(6);
        } elseif ($request->sort_by == 'highest_price') {
            $products = Product::orderBy('selling_price', 'Desc')->paginate(6);
        } elseif ($request->sort_by == 'product_latest') {
            $products = Product::orderBy('created_at', 'Desc')->paginate(6);
        } elseif ($request->sort_by == 'name_a_z') {
            $products = Product::orderBy('products.name', 'asc')->paginate(6);
        } elseif ($request->sort_by == 'name_z_a') {
            $products = Product::orderBy('products.name', 'Desc')->paginate(6);
        } elseif ($request->sort_by == 'male') {
            $products = Product::where('gender', '1')->paginate(6);
        } elseif ($request->sort_by == 'female') {
            $products = Product::where('gender', '0')->paginate(6);
        } elseif ($request->sort_by == 'unisex') {
            $products = Product::where('gender', '2')->paginate(6);
        } else {

        }

        return view('layouts.frontendincludes.listview', compact('products', 'cartitems'));
    }

    public function sort_list(Request $request)
    {
        $cartitems = Cart::where('user_id', Auth::id())->paginate(6);
        if ($request->sort_by == 'Lowest_price') {
            $products = Product::orderBy('selling_price', 'asc')->paginate(6);
        } elseif ($request->sort_by == 'highest_price') {
            $products = Product::orderBy('selling_price', 'Desc')->paginate(6);
        } elseif ($request->sort_by == 'product_latest') {
            $products = Product::orderBy('created_at', 'Desc')->paginate(6);
        } elseif ($request->sort_by == 'name_a_z') {
            $products = Product::orderBy('products.name', 'asc')->paginate(6);
        } elseif ($request->sort_by == 'name_z_a') {
            $products = Product::orderBy('products.name', 'Desc')->paginate(6);
        }

        return view('layouts.frontendincludes.listview', compact('products', 'cartitems'));
    }

    public function gend_by(Request $request)
    {
        $category = Category::where('status', '1')->get();

        $cartitems = Cart::where('user_id', Auth::id())->get();
        $products = Product::where('status', '1')->paginate(6);
        $featured_products = Product::where('trending', '1')
            ->take(15)->get();

        if ($request->gend_by == 'male') {
            // echo $category->id;
            // echo "male";
            $products = Product::where('cate_id', $request->cat_id)->where('gender', '1')->paginate(8);
            //$products = Product::where('gender', '1')->paginate(6);

        } elseif ($request->gend_by == 'female') {
            // echo"female";
            $products = Product::where('gender', '0')->paginate(8);
        } elseif ($request->gend_by == 'unisex') {
            echo 'uni';
            // $products = Product::where('gender', '2')->paginate(6);
        }

        return view('layouts.frontendincludes.productswrtcategory', compact('products', 'cartitems', 'featured_products'));
    }

    public function filterbyprice(Request $request)
    {
        $category = Category::where('status', '1')->get();
        $categories = Category::where('status', '1')->take(15)->get();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $featured_products = Product::where('trending', '1')
            ->take(15)->get();
        $start_price = $request->start_price;
        $end_price = $request->end_price;

        // $products = Product::where('selling_price','>=',$start_price)->where('selling_price','<=',$end_price)->paginate(20);
        // $products = Product::whereBetween(['$start_price','$end_price'])->paginate(20);
        $products = Product::whereBetween('selling_price', [$start_price, $end_price])->paginate(20);

        return view('frontend.loadmore', compact('products', 'categories', 'cartitems', 'featured_products', 'category'));

    }

    public function category()
    {
        $category = Category::where('status', '0')->take(4)->get();

        return view('frontend.category', compact('category'));
    }

    public function viewcategory($slug, Request $request)
    {

        if (Category::where('slug', $slug)->exists()) {

            $sortcolumn = '';
            $sorttype = '';
            $value = '';
            if (isset($request->sort_by)) {
                if ($request->sort_by === 'lowest_price') {
                    $sortcolumn = 'selling_price';
                    $sorttype = 'asc';
                }
                if ($request->sort_by === 'highest_price') {
                    $sortcolumn = 'selling_price';
                    $sorttype = 'desc';
                }
            }
            if ($request->gend_by === 'male') {

                $value = '1';
            }
            if ($request->gend_by === 'female') {
                $value = '0';
            }
            $cartitems = Cart::where('user_id', Auth::id())->get();
            $category = Category::where('slug', $slug)->first();
            $featured_products = Product::where('trending', '1')->get();
            $products = Product::query();
            $products = $products->where('cate_id', $category->id)->where('status', '1');

            if (isset($request->gend_by)) {

                $products = $products->where('gender', $value);

            }

            if (isset($request->start_price) || isset($request->end_price)) {
                $products = $products->whereBetween('selling_price', [$request->start_price, $request->end_price]);
            }

            if (isset($request->sort_by)) {
                $products = $products->orderBy($sortcolumn, $sorttype);

            }

            $products = $products->paginate(24);

            return view('frontend.products', compact('category', 'products', 'cartitems', 'featured_products'));

        } else {
            // return redirect('/')->with('message',"Slug doesnot exists");
            return redirect('/')->with('message', 'Something went wrong!');
        }
    }

    public function productview($cate_slug, $prod_slug)
    {
        // dd($prod_slug);
        if (Category::where('slug', $cate_slug)->exists()) {
            if (Product::where('id', $prod_slug)->exists()) {
                $cartitems = Cart::where('user_id', Auth::id())->get();
                $featured_products = Product::where('trending', '1')->take(15)->get();
                $products = Product::where('id', $prod_slug)->first();

                return view('frontend.productview', compact('products', 'featured_products', 'cartitems'));

            } else {
                return redirect('/')->with('message', 'The link was broken');
            }
        } else {
            return redirect('/')->with('message', 'No such category found');
        }
    }

    public function productlistAjax()
    {
        $products = Product::select('name')->where('status', '1')->get();

        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }
}