<?php

use App\Http\Controllers\Api\MobileController;
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

Route::get('category/{id?}',[MobileController::class,'category']);
Route::get('form',[MobileController::class,'form']);
Route::post('submit-form',[MobileController::class,'submitForm']);

Route::get('slider/{id?}',[MobileController::class,'slider']);
Route::get('category-only/{id?}',[MobileController::class,'categoryOnly']);
Route::get('food/{id?}',[MobileController::class,'food']);
Route::get('food-by-category/{id?}',[MobileController::class,'foodByCategory']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
