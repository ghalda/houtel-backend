<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/loginProses', [App\Http\Controllers\AuthController::class, 'loginProses'])->name('loginProses');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // USER
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/add-user', [App\Http\Controllers\UserController::class, 'add'])->name('add-user');
    Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit-user');
    Route::post('/insert-user', [App\Http\Controllers\UserController::class, 'insert'])->name('insert-user');
    Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update'])->name('update-user');
    Route::get('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete-user');

    // KOTA
    Route::get('/kota', [App\Http\Controllers\KotaController::class, 'index'])->name('kota');
    Route::get('/add-kota', [App\Http\Controllers\KotaController::class, 'add'])->name('add-kota');
    Route::get('/edit-kota/{id}', [App\Http\Controllers\KotaController::class, 'edit'])->name('edit-kota');
    Route::post('/insert-kota', [App\Http\Controllers\KotaController::class, 'insert'])->name('insert-kota');
    Route::post('/update-kota', [App\Http\Controllers\KotaController::class, 'update'])->name('update-kota');
    Route::get('/delete-kota/{id}', [App\Http\Controllers\KotaController::class, 'delete'])->name('delete-kota');

    // HOTEL
    Route::get('/hotel', [App\Http\Controllers\HotelController::class, 'index'])->name('hotel');
    Route::get('/add-hotel', [App\Http\Controllers\HotelController::class, 'add'])->name('add-hotel');
    Route::get('/edit-hotel/{id}', [App\Http\Controllers\HotelController::class, 'edit'])->name('edit-hotel');
    Route::post('/insert-hotel', [App\Http\Controllers\HotelController::class, 'insert'])->name('insert-hotel');
    Route::post('/update-hotel', [App\Http\Controllers\HotelController::class, 'update'])->name('update-hotel');
    Route::get('/delete-hotel/{id}', [App\Http\Controllers\HotelController::class, 'delete'])->name('delete-hotel');

    // HOTEL
    Route::get('/pemesanan', [App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan');

    // BANNER
    Route::get('/banner', [App\Http\Controllers\BannerController::class, 'index'])->name('banner');
    Route::get('/add-banner', [App\Http\Controllers\BannerController::class, 'add'])->name('add-banner');
    Route::get('/edit-banner/{id}', [App\Http\Controllers\BannerController::class, 'edit'])->name('edit-banner');
    Route::post('/insert-banner', [App\Http\Controllers\BannerController::class, 'insert'])->name('insert-banner');
    Route::post('/update-banner', [App\Http\Controllers\BannerController::class, 'update'])->name('update-banner');
    Route::get('/delete-banner/{id}', [App\Http\Controllers\BannerController::class, 'delete'])->name('delete-banner');
});
