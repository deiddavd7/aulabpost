<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/home', function () {
    return redirect(route('homepage'));
})->name('home');

Route::get('/careers', [PublicController::class, 'careers'])->name('careers');
Route::post('/careers/submit', [PublicController::class, 'careersSubmit'])->name('careers.submit');

Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/search', [ArticleController::class, 'searchArticles'])->name('article.search');
Route::get('/article/show/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/article/category/{category}', [ArticleController::class, 'byCategory'])->name('article.byCategory');
Route::get('/article/user/{user}', [ArticleController::class, 'byUser'])->name('article.byUser');

Route::middleware(['auth', 'writer'])->group(function () {
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::patch('/admin/make-admin/{user}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
    Route::patch('/admin/make-revisor/{user}', [AdminController::class, 'makeRevisor'])->name('admin.makeRevisor');
    Route::patch('/admin/make-writer/{user}', [AdminController::class, 'makeWriter'])->name('admin.makeWriter');

    Route::patch('/admin/tag/update/{tag}', [AdminController::class, 'updateTag'])->name('admin.tag.update');
    Route::delete('/admin/tag/delete/{tag}', [AdminController::class, 'deleteTag'])->name('admin.tag.delete');

    Route::patch('/admin/category/update/{category}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/admin/category/delete/{category}', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
});

Route::middleware(['auth', 'revisor'])->group(function () {
    Route::get('/revisor/dashboard', [RevisorController::class, 'dashboard'])->name('revisor.dashboard');

    Route::patch('/revisor/accept/article/{article}', [RevisorController::class, 'acceptArticle'])->name('revisor.acceptArticle');
    Route::patch('/revisor/reject/article/{article}', [RevisorController::class, 'rejectArticle'])->name('revisor.rejectArticle');
    Route::patch('/revisor/undo/article/{article}', [RevisorController::class, 'undoArticle'])->name('revisor.undoArticle');
});

