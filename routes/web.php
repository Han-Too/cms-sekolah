<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
})->name('/');

Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'cekLogin'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'cekAdmin'], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::post('/user/store', [UserController::class, 'store'])->name('storeuser');
        Route::get('/user/delete/{token}', [UserController::class, 'destroy'])->name('deleteuser');
        Route::get('/user/get/{token}', [UserController::class, 'get'])->name('getuser');
        Route::post('/user/edit/{token}', [UserController::class, 'edit'])->name('edituser');
    });
});

