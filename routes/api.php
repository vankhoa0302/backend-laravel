<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUser\{
    LoginController,
    RegisterController
};
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

Route::post('user/login', [LoginController::class, 'authenticate'])
    ->name('user.login');
Route::post('user/register', [RegisterController::class, 'store'])
    ->name('user.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/logout', [LoginController::class, 'logout'])
        ->name('user.logout');
});
