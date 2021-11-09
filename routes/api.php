<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['apiMiddlwr', 'json.response']], function () {

    Route::prefix('todo')->group(function () {

        Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.api');
        Route::post('/register',[\App\Http\Controllers\AuthController::class, 'register'])->name('register.api');
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout.api')->middleware(['auth:api']);

    });

});
