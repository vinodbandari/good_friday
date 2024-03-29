<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\userManage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('admin/viewcontacts', [App\Http\Controllers\AdminContactController::class, 'viewcontacts'])->middleware('admin');
Route::get('clearcart', [App\Http\Controllers\Frontend\CartController::class, 'clearcart']);

Route::get('about', [App\Http\Controllers\FrontendController::class, 'about']);

Route::get('privacy_policies', [App\Http\Controllers\FrontendController::class, 'privacy']);

Route::get('/login/terms_conditions', [App\Http\Controllers\FrontendController::class, 'termsandconditions']);

// ---------------------------------------C O N T A C T   M E ---------------------------------------------
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'contact']);
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'sendmessage']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);
Route::get('category', [App\Http\Controllers\FrontendController::class, 'category']);
Route::get('category/{slug}', [App\Http\Controllers\FrontendController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}', [App\Http\Controllers\FrontendController::class, 'productview']);

Route::get('shopping', [App\Http\Controllers\FrontendController::class, 'loadmore']);

// ------------------A D M I N   C O U P O N   R O U T E S------------------------------------------------

Route::get('/admin/coupons', [App\Http\Controllers\Admin\CouponController::class, 'index'])->middleware('admin');

Route::post('/admin/addcoupon', [App\Http\Controllers\Admin\CouponController::class, 'addcoupon'])->middleware('admin')->name('addcoupon');

Route::post('/check-coupon-code', [App\Http\Controllers\Frontend\CheckoutController::class, 'checkingcoupon']);

Route::post('/admin/editcoupon', [App\Http\Controllers\Admin\CouponController::class, 'editcoupon'])->middleware('admin')->name('editcoupon');

Route::get('/admin/deletecoupon/{id}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->middleware('admin')->name('deletecoupon');

// -------------------------------------------------------------------------------------------------------

// ------------------- G R I D   P R O D U C T S    S O R T -------------------------------------

Route::get('sort-by', [App\Http\Controllers\FrontendController::class, 'sort_by'])->name('sort.by');
Route::get('sort-list', [App\Http\Controllers\FrontendController::class, 'sort_list'])->name('sortlist');

// Route::get('coupon', [App\Http\Controllers\Frontend\CheckoutController::class, 'coupon'])->name('coupon');

// ----------------------------------------------------------------------------------------------

// -------------------------P R O D U C T      S O R T   B Y     G E N D E R-----------------------------

Route::get('gend-by', [App\Http\Controllers\FrontendController::class, 'gend_by'])->name('gend.by');

// ------------------------------------------------------------------------------------------------------

// Route::get('addcart/{id}',[App\Http\Controllers\Frontend\CartController::class, 'AddCart']);

// -----------------S E A R C H       P R O D U C T S-------------------------------------------

Route::get('search', [App\Http\Controllers\SearchController::class, 'search']);

// ---------------------------------------------------------------------------------------------

// Route::get('sorting',[App\Http\Controllers\FrontendController::class, 'sorting']);

Route::get('/filter', [App\Http\Controllers\FrontendController::class, 'filterbyprice']);

// --------------------------------------------------------------------------------------------

//---------------N E W  A D D R E S S    R O U T E S ----------------------------------------

Route::get('newaddress', [App\Http\Controllers\Frontend\UserController::class, 'new_address'])->middleware('auth');
Route::post('newaddress', [App\Http\Controllers\Frontend\UserController::class, 'storeaddress'])->middleware('auth');
Route::get('viewnewaddress', [App\Http\Controllers\Frontend\UserController::class, 'new_address_index'])->middleware('auth');
Route::get('editnewaddress/{address_id}', [App\Http\Controllers\Frontend\UserController::class, 'edit_new_address'])->middleware('auth');
Route::put('updatenewaddress', [App\Http\Controllers\Frontend\UserController::class, 'update_new_address'])->middleware('auth');
Route::delete('deletenewaddress/{new_address}', [App\Http\Controllers\Frontend\UserController::class, 'destroy'])->middleware('auth');
Route::post('default/{id}', [App\Http\Controllers\Frontend\UserController::class, 'default'])->middleware('auth');

// -------------------------------------------------------------------------------------------

Route::post('add-to-cart', [App\Http\Controllers\Frontend\CartController::class, 'addProduct']);

Route::post('buy-now', [App\Http\Controllers\Frontend\CartController::class, 'addProduct']);

// -----------------------C A R T, C H E C K O U T, O R D E R S    R O U T E S -----------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'viewcart']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::post('place-order', [App\Http\Controllers\Frontend\CheckoutController::class, 'placeorder']);
    Route::get('my-orders', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::get('view-address/{id}', [App\Http\Controllers\Frontend\UserController::class, 'view']);
    Route::post('addfeatcart', [App\Http\Controllers\Frontend\CartController::class, 'addFeatProd']);

    Route::post('/delete-cart-item', [App\Http\Controllers\Frontend\CartController::class, 'deleteproduct']);
    Route::post('/update-cart', [App\Http\Controllers\Frontend\CartController::class, 'updatecart']);
    Route::get('/updateminicart', [App\Http\Controllers\Frontend\CartController::class, 'updateminicart']);

    // Route::post('proceed-to-pay',[App\Http\Controllers\Frontend\CheckoutController::class, 'razorpay']);
});

Route::post('delete-cart', [App\Http\Controllers\Frontend\CheckoutController::class, 'delete']);
// ---------------------------------------------------------------------------------------------------------------------------------

// Route::view('/testload', 'layouts.frontendincludes.swiper_trending_prod');
// ------------------I N S T A M O J O    P A Y M E N T   G A T E W A Y    R O U T E S --------------------------
Route::name('instamojo.')
    ->controller(App\Http\Controllers\Frontend\CheckoutController::class)
    ->prefix('instamojo')
    ->group(function () {
        Route::get('success-payment', 'successPayment')->name('success.payment');
    });

Route::get('thankyou', [App\Http\Controllers\ThankyouController::class, 'thank_you']);

// --------------------------------------------------------------------------------

//-------------------------------A D M I N    C A T E G O R Y         R O U T E S --------------------------------------------------
Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('admin')->name('category');
Route::post('/admin/addcategory', [App\Http\Controllers\CategoryController::class, 'addcategory'])->middleware('admin')->name('addcategory');
Route::post('/admin/editcategory', [App\Http\Controllers\CategoryController::class, 'editcategory'])->middleware('admin');
Route::get('/admin/deletecategory/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('admin')->name('deletecategory');
// ---------------------------------------------------------------------------------------------------------------------------------

// -------------------------------A D M I N    P R O D U C T         R O U T E S --------------------------------------------------
Route::get('/admin/product', [App\Http\Controllers\ProductController::class, 'index'])->middleware('admin')->name('product');
Route::post('/admin/addproduct', [App\Http\Controllers\ProductController::class, 'addproduct'])->middleware('admin')->name('addproduct');
Route::post('/admin/editproduct', [App\Http\Controllers\ProductController::class, 'editproduct'])->middleware('admin');
Route::get('/admin/deleteproduct/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('admin')->name('deleteproduct');
Route::get('/live_stock', [App\Http\Controllers\ProductController::class, 'live_stock'])->middleware('admin')->name('live_stock');

// --------------------------------------------------------------------------------------------------------------------------------------------

// -------------------------------A D M I N    U S E R    R O U T E S --------------------------------------------------
// Route::get('admin/users',[App\Http\Controllers\FrontendController::class, 'users'])->middleware('admin');

Route::get('admin/view-user/{id}', [App\Http\Controllers\DashboardController::class, 'viewusers'])->middleware('admin');

Route::get('admin/orders', [App\Http\Controllers\OrderController::class, 'index'])->middleware('admin');
Route::get('admin/view-order/{id}', [App\Http\Controllers\OrderController::class, 'view'])->middleware('admin');
Route::put('update-order/{id}', [App\Http\Controllers\OrderController::class, 'updateorder'])->middleware('admin');
Route::get('order-history', [App\Http\Controllers\OrderController::class, 'orderhistory'])->middleware('admin');
Route::get('admin/users', [App\Http\Controllers\DashboardController::class, 'users'])->middleware('admin');
Route::get('admin/view-user/{id}', [App\Http\Controllers\DashboardController::class, 'viewusers'])->middleware('admin');
// -----------------------------------------------------------------------------------------------------------------------------

// -------------C A R T      C O U N T-----------------------------------------------
Route::get('load-cart-data', [App\Http\Controllers\Frontend\CartController::class, 'cartcount']);
// ----------------------------------------------------------------------------------

// -------------W I S H L I S T     C O U N T-----------------------------------------------
Route::get('load-wishlist-count', [App\Http\Controllers\Frontend\WishlistController::class, 'wishlistcount']);
// -----------------------------------------------------------------------------------------

// ------------W I S H L I S T    R O U T E S----------------------------------------
Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index'])->middleware('auth');
Route::post('add-to-wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'add']);
Route::post('delete-wishlist-item', [App\Http\Controllers\Frontend\WishlistController::class, 'deleteitem']);

// -----------------------------------------------------------------------------------

// ------------------------------ H O M E        P A G E        R O U T E---------------------------------------------
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
// --------------------------------------------------------------------------------------------------

//--------------------U S E R   M A N A G E       R O U T E S---------------------------------------------------------
Route::view('/myaccount', 'myaccount')->middleware('admin');
Route::post('/adduser', [userManage::class, 'adduser'])->middleware('admin')->name('addmember');
Route::post('/edituser', [userManage::class, 'edituser'])->middleware('admin')->name('editmember');

Route::get('/deleteuser/id/{id}', function ($id) {
    $var = deleteuser($id);

    return redirect()->back()->with('message', $var);
})->middleware('admin');



// My Pracises
Route::get('product/export/',[App\Http\Controllers\ProductController::class,'export']);

// -------------------------------------------------------------------------------------------------

// Route::get('address',[AddressController::class,'index']);
// Route::post('address',[AddressController::class,'store']);
// Route::get('edit-address/{id}',[AddressController::class,'edit']);
// Route::put('update-address',[AddressController::class,'update']);
// Route::get('fetch-address',[AddressController::class,'fetchaddress']);