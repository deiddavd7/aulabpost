<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Models\Category;
use App\Models\User;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/home', function () {
    return redirect()->route('homepage');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/articles/category/{category}', [ArticleController::class, 'byCategory'])->name('article.byCategory');
Route::get('/articles/user/{user}', [ArticleController::class, 'byUser'])->name('article.byUser');

