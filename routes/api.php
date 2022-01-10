<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAuth;


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

Route::post('/auth', [UserController::class, 'auth']);

Route::group(['middleware' => [CheckAuth::class]], function () {
    Route::get('/brands', [BrandController::class, 'index']);

    Route::get('/types', [TypeController::class, 'index']);
    
    Route::get('/cars', [CarController::class, 'index']);
    
    Route::post('/brands', [BrandController::class, 'create']);
    
    Route::post('/types', [TypeController::class, 'create']);
    
    Route::delete('/cars/{id}', [CarController::class, 'destroy']);
});