<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TranslationController;

Route::get('/', [BookController::class, 'index']);
Route::resource('books', BookController::class);
Route::get('/show/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('translate/{id}', [TranslationController::class, 'show'])->name('translations.show');
Route::post('/translations/{id}', [TranslationController::class, 'store'])->name('translations.store');