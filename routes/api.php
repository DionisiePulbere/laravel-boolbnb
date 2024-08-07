<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ServiceController;


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
Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);
Route::get('/apartment_image/{filename}', [imageController::class, 'show']);
Route::get('/search/{distance?}/{longitude?}/{latitude?}', [ApartmentController::class, 'search']);
Route::get('/apartment_image/{filename}', [ImageController::class, 'show']);
Route::post('/apartments/message', [MessageController::class, 'store']);
Route::get('/services', [ServiceController::class, 'services']);



