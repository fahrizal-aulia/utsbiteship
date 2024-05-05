<?php

use App\Http\Controllers\ApiOrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/dashboard/orders', [ApiOrdersController::class, 'index']);
Route::post('/dashboard/orders/{id}/approve', [ApiOrdersController::class, 'approve']);
Route::post('/dashboard/orders/{id}/reject', [ApiOrdersController::class, 'reject']);
Route::post('/dashboard/orders/{id}/revisi', [ApiOrdersController::class, 'revisi']);
