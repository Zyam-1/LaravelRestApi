<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\AuthHandler;


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
Route::get('products/search/{name}', [productController::class, 'search']); //Search product using name or other element
Route::get('/products', [productController::class, 'index']); // post all prods
Route::get('/products/{id}', [productController::class, 'show']); // get a single product using id
Route::post('/register', [AuthHandler::class, 'register']); // Route to register a user
Route::post('/login', [AuthHandler::class, 'login']);


// protected routes only accessed by authenticated users
Route::put("/products/{id}", [productController::class, 'update'])->middleware(['auth:sanctum']);
Route::post('/products', [productController::class, 'store'])->middleware(['auth:sanctum']);
Route::delete("/products/{id}", [productController::class, 'destroy'])->middleware(['auth:sanctum']);
Route::post("/logout", [AuthHandler::class, 'logout'])->middleware(["auth:sanctum"]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


