<?php

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;

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

Route::get('/',  [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// dashboard
// dashboad
Route::get('/dashboard', [ProductsController::class, 'dashboard'])->middleware('auth');
Route::resource('/dashboard/product', ProductsController::class)->middleware('auth');
Route::resource('/dashboard/carts', CartController::class)->middleware('auth');
Route::post('/dashboard/carts/drop', [CartController::class, 'drop'])->name('carts.drop')->middleware('auth');;
Route::resource('/dashboard/checkout', CheckoutController::class)->middleware('auth');
Route::post('dashboard/checkout/saveDraft', [CheckoutController::class, 'saveDraft'])->name('checkout.saveDraft');
Route::post('dashboard/checkout/submitApproval', [CheckoutController::class, 'submitApproval'])->name('checkout.submitApproval');


Route::resource('/dashboard/orders', OrdersController::class)->middleware('auth');
// Route::get('/categories', function () {
//     return view('categories', [
//         'title' => 'Categories Produk',
//         "active" => 'categories',
//         'categories' => ProductCategory::all()
//     ]);
// });