<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

//Route::get('/home', function () {
//    return view('home');
//})->name('home');

//display products
Route::get('/home', [ProductController::class, 'index'])->name('home');

//add product
Route::post('/productForm', [ProductController::class, 'store'])->name('storeProduct');

//update product
Route::post('/productForm/{id}', [ProductController::class, 'update'])->name('updateProduct');

//delete product
Route::delete('/product/{id}', [ProductController::class,'destroy'])->name('destroyProduct');


//product content
Route::get('/product/{id}', [ProductController::class, 'show'])->name('showProduct');


//product form
Route::get('/productForm', function () {
    $id = request("id");
    $id = ["id" => $id];
    if (request("id") === null) {
        return view('productForm');
    } else {
        // Handle the case where 'id' is not present, perhaps redirect or show an error.
        return view('productForm', compact("id"));
    }
})->name('productForm');
