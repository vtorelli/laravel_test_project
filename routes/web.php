<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/', [ArticleController::class, 'index']);

Route::post('/articles', [ArticleController::class, 'store'])->name('articles_store');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles_create');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article_show');


Route::get('/users/{id}', [UserController::class, 'show'])->name('user_show');

Route::post('/comments', [CommentController::class, 'store'])->name('comments_store');
Route::get('/comments/verify/{token}', [CommentController::class, 'verify'])->name('comments_verify');




Route::get('/contact', function () {
  return view('contact');
});

Route::get('/about', function () {
  return view('about');
});

Route::get('/user/{id}', function ($id) {
  return view('users_show', compact('id'));
});

Route::get('/login', function () {
  return view('auth_login');
});

Route::get('/backoffice', function () {
  return view('backoffice_index');
});
