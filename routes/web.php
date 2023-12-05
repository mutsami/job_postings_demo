<?php

use App\Http\Controllers\ProductController;

use App\Http\Controllers\SignInController;


use App\Http\Controllers\HomeController;

use App\Http\Controllers\AboutusController;


use Illuminate\Http\Request;

use App\Models\Product;

use Illuminate\Support\Facades\Auth;



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

 
Route::resource('/', HomeController::class);


Route::resource('/aboutus', AboutusController::class);


Route::middleware(['auth'])->group(function () {
    // Routes that require authentication go here
    Route::resource('/products', ProductController::class); 
});
 
Route::resource('/signin', SignInController::class);
 

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
 
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);


Route::get('/auth/logout', [ProviderController::class, 'logout']);


Route::get('/', function () {
 
    // Get the currently signed-in user
    $user = Auth::user();
    

    // Check for search input
    if (request('search')) {
        $products = Product::where('name', 'like', '%' . request('search') . '%')->get() ;
        
    } else {
        $products = Product::all(); 
    }
 

    return view('home', compact('products', 'user'));

});