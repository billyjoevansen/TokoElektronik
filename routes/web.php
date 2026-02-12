<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
| Route yang harus login dulu
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard',
        [ProductController::class, 'dashboard'])
        ->middleware('auth')
        ->name('dashboard');

    Route::resource('produk', ProductController::class);
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::post('/profile/update',
    [App\Http\Controllers\ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::get('/produk/laporan/pdf',
    [ProductController::class, 'exportPdf'])
    ->name('produk.laporan.pdf')
    ->middleware('auth');

/*
| Auth routes (Laravel Breeze)
*/
require __DIR__.'/auth.php';

