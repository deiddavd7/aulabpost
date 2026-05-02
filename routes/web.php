<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/home', function () {
    return redirect()->route('homepage');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');

    Route::get('/careers', [PublicController::class, 'careers'])->name('careers');
    Route::post('/careers/submit', [PublicController::class, 'careersSubmit'])->name('careers.submit');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::patch('/admin/make-admin/{user}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
    Route::patch('/admin/make-revisor/{user}', [AdminController::class, 'makeRevisor'])->name('admin.makeRevisor');
    Route::patch('/admin/make-writer/{user}', [AdminController::class, 'makeWriter'])->name('admin.makeWriter');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');


Route::get('/articles/category/{category}', [ArticleController::class, 'byCategory'])->name('article.byCategory');
Route::get('/articles/user/{user}', [ArticleController::class, 'byUser'])->name('article.byUser');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('article.show');

