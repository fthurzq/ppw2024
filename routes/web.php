<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register','register')->name('register');
    Route::post('/store','store')->name('store');
    Route::get('/login','login')->name('login');
    Route::post('/authenticate','authenticate')->name('authenticate');
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::post('/logout','logout')->name('logout');
});

// routing untuk menerapkan middleware
Route::get('restricted', function() {
    return redirect()-> route('dashboard')->withSuccess("Anda berusia lebih dari 18 tahun!");
})->middleware('checkage');

// routing middleware admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Rute lain yang hanya bisa diakses oleh admin
});