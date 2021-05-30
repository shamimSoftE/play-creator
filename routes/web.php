<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\BankController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\FrontEnd::class, 'home']  )->name('guest_home');
Route::get('coin-buy', [\App\Http\Controllers\FrontEnd::class, 'coinList'])->name('coin_list');
Route::get('/search-item', [\App\Http\Controllers\FrontEnd::class, 'search'])->name('search_item');
//Route::get('category-product-{id}', [\App\Http\Controllers\FrontEnd::class, 'catePro'])->name('cate_pro');

/*======================== buy coin & uc =======================================*/
Route::get('checkout-{id}',[\App\Http\Controllers\CheckoutController::class, 'checkout'])->name('payment_page');
Route::post('payment-success',[\App\Http\Controllers\CheckoutController::class, 'complete'])->name('payment_completed');
/*===================== pay with bank transfer */
Route::post('pay-with-bank-',[\App\Http\Controllers\BankTransferController::class, 'bank'])->name('pay_with_bank');


Route::post('product-buy',[\App\Http\Controllers\CheckoutController::class, 'buyConfirm'])->name('buy_product');
/*=========================== end buy coin & uc route ===============================*/
Route::get('/dashboard', function () {
    return view('FrontEnd.home.home');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user-profile', [\App\Http\Controllers\FrontEnd::class, 'dashboard'])->name('user_profile');
    Route::get('product-purchased', [\App\Http\Controllers\FrontEnd::class, 'purchasedProduct'])->name('purchased_product');
    Route::get('coin-purchased', [\App\Http\Controllers\FrontEnd::class, 'purchasedCoin'])->name('purchased_coin');
    Route::get('new-order', [\App\Http\Controllers\FrontEnd::class, 'OrderManage'])->name('user_order');

    /*================= chatting ===================================== */
    Route::get('chatting-{id}', [\App\Http\Controllers\ChattingController::class, 'chat'])->name('chat_box');
    Route::post('message-store', [\App\Http\Controllers\ChattingController::class, 'store'])->name('store_message');
    Route::get('user-message-view-{id}', [\App\Http\Controllers\ChattingController::class, 'viewMessage'])->name('user_sms_view');
    /*================= end chatting ===================================== */

    /* ======================== seller ======================= */
    Route::get('seller-request', [\App\Http\Controllers\SellerController::class, 'create'])->name('seller_form');
    Route::post('seller-data', [\App\Http\Controllers\SellerController::class, 'store'])->name('seller_store');
    /* ========================= seller ======================== */

    Route::get('/user-product', [\App\Http\Controllers\UserController::class, 'index'])->name('user_post');
    Route::get('/user-product', [\App\Http\Controllers\UserController::class, 'create'])->name('user_product_create');
    Route::post('/user-product-save', [\App\Http\Controllers\UserController::class, 'store'])->name('user_save');
    Route::post('/user-product-update-{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('pro_update');

    Route::get('/product-inactive-{id}', [\App\Http\Controllers\UserController::class, 'hide'])->name('product_hide');
    Route::get('/product-active-{id}', [\App\Http\Controllers\UserController::class, 'active'])->name('product_active');
    Route::post('/product-delete-{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('product_destroy');
});

Route::prefix('admin')->group(function (){

    Route::get('/login', [AdminController::class, 'login'])->name('admin_login_form');
    Route::post('/login-check', [AdminController::class, 'check'])->name('login_check');
    Route::post('/log-out', [AdminController::class, 'logout'])->name('admin_logout');
    /* Route::get('/register', [AdminController::class, 'register'])->name('admin_register');*/
    Route::post('/login-store', [AdminController::class, 'store'])->name('admin_store');


});

/*========================  front side end ========================*/

Route::group(['middleware' => 'admin'], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
        Route::get('/create', [AdminController::class, 'create'])->name('admin_create');
        Route::get('-list', [AdminController::class, 'index'])->name('admin_index');
        Route::get('-profile-{id}', [AdminController::class, 'profile'])->name('admin_profile');
        Route::post('-profile-update', [AdminController::class, 'update'])->name('admin_update');
        Route::post('-destroy-{id}', [AdminController::class, 'destroy'])->name('admin_destroy');
    });

    /*=============== seller ==============*/
    Route::get('seller-list', [\App\Http\Controllers\SellerController::class, 'index'])->name('seller_list');
    Route::get('seller-inactive-{id}', [\App\Http\Controllers\SellerController::class, 'Inactive'])->name('seller_hide');
    Route::get('seller-active-{id}', [\App\Http\Controllers\SellerController::class, 'active'])->name('seller_active');
    Route::post('seller-list-{id}', [\App\Http\Controllers\SellerController::class, 'destroy'])->name('seller_destroy');
    /*=============== seller ==============*/

    /* ========================= customer message ======================== */
    Route::get('message-view-{id}', [\App\Http\Controllers\ChattingController::class, 'readMessage'])->name('message_read');
    Route::post('message-reply', [\App\Http\Controllers\ChattingController::class, 'replyMessage'])->name('reply_sms');
    /* ========================= customer message end ======================== */

    /*=============== category ==============*/

    Route::resource('category', CategoryController::class );
    Route::get('category-show-{id}',[ CategoryController::class, 'active'])->name('cate-active');
    Route::get('category-hide-{id}',[ CategoryController::class, 'hide'])->name('cate_inactive');
    /*================ end category ================ */

    /*================  section ================ */
    Route::resource('section', SectionController::class);
    Route::get('/section-active-{id}', [SectionController::class, 'active'])->name('section_active');
    Route::get('/section-inactive-{id}', [SectionController::class, 'hide'])->name('section_hide');
    /*================ end section ================ */


    /*================  Post ================ */

    Route::resource('product', \App\Http\Controllers\PostController::class);
    Route::get('/active/{id}', [\App\Http\Controllers\PostController::class, 'active'] )->name('post_active');
    Route::get('/inactive/{id}', [\App\Http\Controllers\PostController::class, 'hide'])->name('post_hide');
    /*================ end product ================ */

    /*================  coin ================ */
    Route::resource('coin', CoinController::class);
    Route::get('coin-show-{id}',[CoinController::class, 'active'])->name('coin-active');
    Route::get('coin-hide-{id}',[CoinController::class, 'hide'])->name('coin_inactive');
    /*================ end coin ================ */

    /*================ sold by coin ================ */
    Route::get('/sold-by-coin', [ \App\Http\Controllers\BuyCoinController::class, 'index'])->name('soldBy_index');
    Route::post('/sell-coin-delete-{id}', [ \App\Http\Controllers\BuyCoinController::class, 'trash'])->name('coin_sold_destroy');
    /*================ end sold by coin ================ */

    /*================ pay with bank ================ */
    Route::get('/order-list', [\App\Http\Controllers\BankTransferController::class, 'index'])->name('order_list');
    Route::get('/order-confirm-{id}', [\App\Http\Controllers\BankTransferController::class, 'confirm'])->name('order_confirm');
    Route::get('/check-view-{id}', [\App\Http\Controllers\BankTransferController::class, 'checkView'])->name('view_check');
    Route::post('/order-destroy-{id}', [\App\Http\Controllers\BankTransferController::class, 'destroy'])->name('order_destroy');
    /*================ end pay with bank ================ */


    /*================ bank add ================ */
    Route::resource('bank', BankController::class);
    Route::get('active-{id}', [ BankController::class, 'active'])->name('bank_active');
    Route::get('inactive-{id}', [ BankController::class, 'inactive'])->name('bank_inactive');

    /*================ bank end ================ */


});



require __DIR__.'/auth.php';
