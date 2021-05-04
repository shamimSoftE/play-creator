<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CoinController;

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
//Route::get('process-to-checkout-{id}', [\App\Http\Controllers\FrontEnd::class, 'checkout'])->name('payment_page');

Route::get('checkout-{id}',[\App\Http\Controllers\CheckoutController::class, 'checkout'])->name('payment_page');
Route::post('payment-success',[\App\Http\Controllers\CheckoutController::class, 'complete'])->name('payment_completed');

Route::get('/dashboard', function () {
    return view('FrontEnd.home.home');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user-profile', [\App\Http\Controllers\FrontEnd::class, 'dashboard'])->name('user_profile');

    Route::get('/user-post', [\App\Http\Controllers\UserController::class, 'index'])->name('user_post');
    Route::get('/user-post', [\App\Http\Controllers\UserController::class, 'create'])->name('user_post_create');
    Route::post('/user-post-save', [\App\Http\Controllers\UserController::class, 'save'])->name('user_save');
});

Route::prefix('admin')->group(function (){

    Route::get('/login', [AdminController::class, 'login'])->name('admin_login_form');
    Route::post('/login-check', [AdminController::class, 'check'])->name('login_check');
    Route::post('/log-out', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/register', [AdminController::class, 'register'])->name('admin_register');
    Route::post('/login-store', [AdminController::class, 'store'])->name('admin_store');


});

/*========================  front side end ========================*/

Route::group(['middleware' => 'admin'], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    });

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

    Route::resource('post', \App\Http\Controllers\PostController::class);
    Route::get('/active/{id}', [\App\Http\Controllers\PostController::class, 'active'] )->name('post_active');
    Route::get('/inactive/{id}', [\App\Http\Controllers\PostController::class, 'hide'])->name('post_hide');
    /*================ end post ================ */

    /*================  coin ================ */
    Route::resource('coin', CoinController::class);
    Route::get('coin-show-{id}',[CoinController::class, 'active'])->name('coin-active');
    Route::get('coin-hide-{id}',[CoinController::class, 'hide'])->name('coin_inactive');
    /*================ end coin ================ */


});



require __DIR__.'/auth.php';
