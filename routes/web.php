<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('index');
});

Route::get('/articles/{id}', function ($id) {
  return view('articles.show', compact('id'));
});

Route::get('/user/{id}', function ($id) {
  return view('users.show', compact('id'));
});

Route::get('/login', function () {
  return view('auth.login');
});

Route::get('/backoffice', function () {
  return view('backoffice.index');
});
