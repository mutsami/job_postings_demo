<?php

use App\Http\Controllers\ProductController;

use App\Http\Controllers\SignInController;

use App\Http\Controllers\Auth\ProviderController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Routes that require authentication go here
    Route::resource('/products', ProductController::class); // Replace 'ProductController@index' with your actual controller and method.
});
 
Route::resource('/signin', SignInController::class);
 

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
 
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);


Route::get('/auth/logout', [ProviderController::class, 'logout']);