<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->name('api.v1')->namespace('Api\V1')->group(function () {
    Route::post('login', [LoginController::class,'login'])->name('login');
    Route::post('register', [LoginController::class,'register'])->name('register');
    Route::post('forgotPassword', [ProfileController::class, 'forgotPassword'])->name('forgotPassword');
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('getProfile', [ProfileController::class, 'getProfile'])->name('getProfile');
        Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::post('updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    });
});
