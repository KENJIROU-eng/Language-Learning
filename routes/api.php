<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LearnController;

Route::get('/vue/test', [LearnController::class, 'vueTest']);
