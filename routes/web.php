<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Models\ProductCategory;

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
Route::get('/dashboard/product/{id}', [ProductsController::class, 'show'])->middleware('auth');
// Route::get('/categories', function () {
//     return view('categories', [
//         'title' => 'Categories Produk',
//         "active" => 'categories',
//         'categories' => ProductCategory::all()
//     ]);
// });