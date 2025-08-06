<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('users', UserController::class);
        Route::get('/wallets', [WalletController::class, 'index']);
        Route::get('/wallets/{id}', [WalletController::class, 'show']);
        Route::post('/wallets/topup', [WalletController::class, 'topup']);
        Route::post('/wallets/withdraw', [WalletController::class, 'withdraw']);

        Route::apiResource('products', ProductController::class);
        Route::apiResource('transactions', TransactionController::class);
        Route::get('/reports', [ReportController::class, 'index']);
        Route::put('/reports/{id}', [ReportController::class, 'update']);
    });

});
