<?php

use App\Http\Controllers\Api\Products;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();  
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', "login")->name("login");
    Route::post('/signup', "signup")->name("signup");
    Route::get('/register', "logout")->name("logout");
});
Route::controller(Products::class)->group(function () {
    Route::get('/products', "index");
    Route::get('/products/category/{category}', "index");
    Route::get('/products/{product_id}', "show");
    Route::get('/products/{product_id}/{theme_id}', "show");
});
Route::get('/products/catagorys',function(){
  return response()->json(['shoes','clothes','food']);
});
