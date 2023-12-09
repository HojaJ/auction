<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('purchases', [App\Http\Controllers\PurchaseController::class, 'getUserPurchases'])->name('purchases');

});
Route::get('/lot_bid', [\App\Http\Controllers\LotController::class, 'getMaxBid'])->name('bids');

