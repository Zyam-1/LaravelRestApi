<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;


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

// public routes
Route::get('products/search/{name}', [productController::class, 'search']); //get all prods
Route::get('/products', [productController::class, 'index']); // post all prods

// protected routes only accessed by authenticated users


Route::post('/products', [productController::class, 'store'])->middleware(['auth:sanctum']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


