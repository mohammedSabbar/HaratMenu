<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SliderController;
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



Auth::routes();

Route::get('/menu/{id?}',[HomeController::class,'menu'])->name('menu');
Route::get('/food-by-category/{id}',[HomeController::class,'foodByCategory'])->name('menu.foodByCategory');
Route::get('/menu-description/{id?}',[HomeController::class,'description'])->name('menu.description');
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('food', FoodController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('form', FormController::class);
    Route::resource('slider', SliderController::class);
    Route::get('print/{id}', [HomeController::class,'print'])->name('print');
    Route::get('print-all', [HomeController::class,'printAll'])->name('printAll');
    Route::get('search-by-date', [FormController::class,'searchByDate'])->name('searchByDate');
    Route::get('qr', [HomeController::class,'qr'])->name('qr');
});
