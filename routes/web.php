<?php

use App\Http\Controllers\Admin\LotsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\LotImageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profile/add-money', [App\Http\Controllers\ProfileController::class, 'topUpBalance'])->name('profile.addMoney');

    Route::resource('lots', LotController::class);
    Route::delete('lot-images/{id}', [LotImageController::class, 'destroy'])->name('lot-images.destroy');
    Route::post('bid', [App\Http\Controllers\BidController::class, 'store'])->name('bid');

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['role:1']
    ], function () {
        Route::resource('users', UsersController::class)->only('index', 'edit', 'update');
        Route::resource('lots', LotsController::class)->only('index', 'destroy');
    });


});

require __DIR__.'/auth.php';
