<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

Route::prefix('/accounts')->group(function () {
    Route::post('/', [AccountController::class, 'all']);
    Route::post('/add', [AccountController::class, 'add']);
    Route::get('/edit/{id}', [AccountController::class, 'edit']);
    Route::post('/upd', [AccountController::class, 'upd']);
    Route::get('/del/{id}', [AccountController::class, 'del']);
});

Route::prefix('/categories')->group(function () {
    Route::post('/', [CategoryController::class, 'all']);
    Route::post('/add', [CategoryController::class, 'add']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/upd', [CategoryController::class, 'upd']);
    Route::get('/del/{id}', [CategoryController::class, 'del']);
});

Route::prefix('/products')->group(function () {
    Route::post('/', [ProductController::class, 'all']);
    Route::post('/add', [ProductController::class, 'add']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/upd', [ProductController::class, 'upd']);
    Route::get('/del/{id}', [ProductController::class, 'del']);
});
