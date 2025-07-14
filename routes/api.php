<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LearnController;
use App\Http\Controllers\AuthController;

Route::middleware('guest')->post('/register', [AuthController::class, 'register']);
Route::middleware('guest')->post('/login', [AuthController::class, 'login']);

//sanctum 認証
Route::middleware(['web', 'auth:sanctum'])
    ->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/vue/learn/translate', [LearnController::class, 'translate']);
        Route::patch('/vue/learn/update', [LearnController::class, 'update']);
        Route::get('/vue/learn/fileList', [LearnController::class, 'fileList']);
        Route::get('/vue/learn/{fileName}/index', [LearnController::class, 'index']);
        Route::get('/vue/learn/{fileName}/memorize', [LearnController::class, 'memorize']);
        Route::get('/vue/learn/notice', [LearnController::class, 'notice']);
    });

// Route::get('/vue/test', [LearnController::class, 'vueTest']);

