<?php

use App\Http\Controllers\AdmainController;
use App\Http\Controllers\CSRFController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OwnerRole;
use App\Models\Owner;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
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

// Route::view('/{path?}', 'index')->where(['path' => '^((?!api).)*$']);

Route::view('/','pages.login');

Route::controller(AdmainController::class)->group(function () {
  Route::post('/login', "login")->name("login");
  Route::get('/logout', "logout")->name("logout");
});

Route::group(['middleware'=>'auth.owner'],function(){
  Route::view('/dashboard',"layout.dashboard");
  Route::resource('/store', StoreController::class);
  Route::resource('/themes', ThemeController::class);
  Route::resource('/users',UserController::class);
  Route::get('/themes/{product_id}/add', [ThemeController::class, 'addtheme'])->name('themes.add');
});



Route::get('/storage/{file}/{image}', function ($file, $image) {
  $path = storage_path("app/public/$file/$image");
  if (!file_exists($path)) {
    abort(404);
  }
  return response()->file($path);
});

  