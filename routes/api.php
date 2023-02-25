<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list-kota', [App\Http\Controllers\Api\ApiKotaController::class, 'listKota']);
Route::get('/detail-kota/{id}', [App\Http\Controllers\Api\ApiKotaController::class, 'detailKota']);

Route::get('/list-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'listHotel']);
Route::get('/rekomendasi-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'hotelRekomendasi']);
Route::get('/detail-hotel/{id}', [App\Http\Controllers\Api\ApiHotelController::class, 'detailHotel']);
Route::get('/search-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'searchHotel']);
Route::get('/search-rekomendasi-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'searchRekomendasiHotel']);

Route::post('/post-pemesanan', [App\Http\Controllers\Api\ApiPemesananController::class, 'postPemesanan']);

Route::get('/list-banner', [App\Http\Controllers\Api\ApiBannerController::class, 'listBanner']);