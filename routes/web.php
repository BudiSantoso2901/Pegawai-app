<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dash');
// });

Route::get('/', [ChartController::class, 'index']);

//register
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/proses-register', [UserController::class, 'processRegister'])->name('Proses-register');
//login
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/process-login', [UserController::class, 'processLogin'])->name('Process-login');
Route::get('/process-logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('User')->middleware(['auth', 'check-access:0'])->group(function () {
});
Route::prefix('Admin')->middleware(['auth', 'check-access:1'])->group(function () {
    Route::get('/view', [PegawaiController::class, 'index'])->name('admin.view');
    Route::get('/user/{id}', [PegawaiController::class, 'show'])->name('admin.user.show');
    Route::post('/user', [PegawaiController::class, 'store'])->name('admin.user.store');
    Route::put('/user/{id}', [PegawaiController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{id}', [PegawaiController::class, 'destroy'])->name('admin.user.destroy');
});
