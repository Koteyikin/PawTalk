<?php

use App\Http\Controllers\article\ArticleController;
use App\Http\Controllers\article\ArticleFunctionController;
use App\Http\Controllers\article\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{id}', [ArticleFunctionController::class, 'show'])->name('articles.show');
Route::post('articles', [ArticleFunctionController::class, 'store'])->name('articles.store');
Route::post('articles/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/likes', [LikeController::class, 'toggle'])->name('likes.toggle');
Route::post('/bookmarks', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
Route::get('/posts', [ArticleController::class, 'index'])->name('articles.search');
Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('profile/createAnimal', [ProfileController::class, 'animal'])->name('profile.animal');
});


Route::middleware('guest')->group(function () {
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

});


