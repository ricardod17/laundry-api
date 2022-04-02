<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BookController;
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

Route::middleware('auth:sanctum')->get('/auth', function (Request $request) {
    return $request->user();
});
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

Route::get('/jasa', [JasaController::class, 'index'])->middleware('jwt.verify');
Route::post('/jasa', [JasaController::class, 'create'])->middleware('jwt.verify');
Route::get('/jasa/{id}', [JasaController::class, 'view'])->middleware('jwt.verify');
Route::post('/jasa/{id}', [JasaController::class, 'update'])->middleware('jwt.verify');
Route::delete('/jasa/{id}', [JasaController::class, 'delete'])->middleware('jwt.verify');


Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('jwt.verify');
Route::post('/transaksi', [TransaksiController::class, 'create'])->middleware('jwt.verify');
Route::get('/transaksi/{id}', [TransaksiController::class, 'view'])->middleware('jwt.verify');
Route::post('/transaksi/{id}', [TransaksiController::class, 'update'])->middleware('jwt.verify');
Route::post('/transaksi/status/{id}', [TransaksiController::class, 'status'])->middleware('jwt.verify');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'delete'])->middleware('jwt.verify');