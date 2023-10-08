<?php

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





use App\Http\Controllers\productsController;
use App\Http\Controllers\categoryController;
use App\Models\category;

// ************************ productsController ****************************

Route::get('/home',function(){
    return view('home');
})->name("home");
Route::get('/', [productsController::class ,"landingPage"] );

Route::get('products', [productsController::class ,"products"] )->name("product.index");
Route::get("/formInput/create",[productsController::class ,"form_input"] )->name("product.input");
Route::get("/formInput/update/{id}",[productsController::class ,"form_update"] )->name("product.update");
Route::get("/product_details/{id}",[productsController::class ,"get_product_details"] )->name("product.show");
Route::get("/product_details/{id}/delete",[productsController::class ,"destroy"] )->name("product.destroy");
Route::post('products/', [productsController::class ,"store"] )->name("product.store");
Route::post('products/update', [productsController::class ,"edit"] )->name("product.edit");
// Route::get("/product_details/{id}/delete",[productsController::class ,"destroy"] )->name("product.destroy")->middleware('auth');
// Route::post('products/', [productsController::class ,"store"] )->name("product.store")->middleware('auth');
// Route::post('products/update', [productsController::class ,"edit"] )->name("product.edit")->middleware('auth');
Route::get("/about",[productsController::class ,"aboutPage"] );
Route::get("/contact",[productsController::class ,"contactPage"] );

// ************************ categoryController ****************************

Route::resource("category",categoryController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
