<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LearnController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('layouts.app'); // app.blade.php に Vue アプリを読み込む
})->where('any', '.*');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     #profile
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     #Learn
//     Route::get('/learn/create', [LearnController::class, 'create'])->name('learn.create');
//     Route::post('/learn/translate', [LearnController::class, 'translate'])->name('learn.translate');
//     Route::get('/learn/fileList', [LearnController::class, 'fileList'])->name('learn.fileList');
//     Route::get('/learn/{fileName}/index', [LearnController::class, 'index'])->name('learn.list');
//     Route::get('/learn/{fileName}/memorize', [LearnController::class, 'memorize'])->name('learn.memorize');
//     Route::patch('/learn/update', [LearnController::class, 'update'])->name('learn.update');
//     Route::post('/learn/notice', [LearnController::class, 'notice'])->name('learn.notice');

//     #vue
//     Route::get('/vue-test', fn() => view('vuePractice'));

// });

require __DIR__.'/auth.php';
