<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function (Request $request) {
    return response()->json([
        "success" => true,
        "message" => "Welcome to Internal API Laundry.",
    ]);
}
);

Route::get('user/auth', [UserController::class, 'getAuthenticatedUser'])->middleware('jwt.verify');
Route::post('register', [UserController::class, 'register']);
Route::post('login',  [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'index'])->middleware('jwt.verify');
Route::post('/user', [UserController::class, 'create'])->middleware('jwt.verify');
Route::get('/user/{id}', [UserController::class, 'view'])->middleware('jwt.verify');
Route::post('/user/{id}', [UserController::class, 'update'])->middleware('jwt.verify');
Route::delete('/user/{id}', [UserController::class, 'delete'])->middleware('jwt.verify');

Route::get('/product', [ProductController::class, 'index'])->middleware('jwt.verify');
Route::post('/product', [ProductController::class, 'create'])->middleware('jwt.verify');
Route::get('/product/{id}', [ProductController::class, 'view'])->middleware('jwt.verify');
Route::post('/product/{id}', [ProductController::class, 'update'])->middleware('jwt.verify');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->middleware('jwt.verify');


Route::get('/transaction', [TransactionController::class, 'index'])->middleware('jwt.verify');
Route::post('/transaction', [TransactionController::class, 'create'])->middleware('jwt.verify');
Route::get('/transaction/{id}', [TransactionController::class, 'view'])->middleware('jwt.verify');
Route::post('/transaction/{id}', [TransactionController::class, 'update'])->middleware('jwt.verify');
Route::post('/transaction/status/{id}', [TransactionController::class, 'status'])->middleware('jwt.verify');
Route::delete('/transaction/{id}', [TransactionController::class, 'delete'])->middleware('jwt.verify');