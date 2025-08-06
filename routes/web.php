<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BankMiniController;

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

Route::get('/', [App\Http\Controllers\AuthWebController::class, 'home']);

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('/login', [AuthWebController::class, 'login']);
Route::post('/register', [AuthWebController::class, 'register']);
Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::resource('users', UserController::class)->except(['show']);
    Route::prefix('toko')->middleware('can:isToko')->group(function () {
        Route::resource('products', ProductController::class)->except(['show'])->names('toko.products');
        Route::get('sales-history', [ProductController::class, 'salesHistory'])->name('toko.sales_history');
    });
});

Route::view('/admin/dashboard', 'admin.dashboard');
Route::view('/siswa/dashboard', 'siswa.dashboard');
Route::view('/toko/dashboard', 'toko.dashboard');
Route::get('/bankmini/dashboard', [BankMiniController::class, 'dashboard'])->name('bankmini.dashboard');

Route::get('/bankmini/transactions/history', [BankMiniController::class, 'history'])->name('bankmini.transactions.history');
Route::post('/transactions/topup', [TransactionController::class, 'topup'])->name('transactions.topup');

// Debug routes
Route::get('/debug/upload', [App\Http\Controllers\DebugController::class, 'show'])->name('debug.upload');
Route::post('/debug/upload', [App\Http\Controllers\DebugController::class, 'upload'])->name('debug.upload');
Route::post('/transactions/withdrawal', [TransactionController::class, 'withdrawal'])->name('transactions.withdrawal');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
