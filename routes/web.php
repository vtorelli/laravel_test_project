<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('index');
});

Route::get('/contact', function () {
  return view('contact');
});

Route::get('/about', function () {
  return view('about');
});

Route::get('/articles/{id}', function ($id) {
  return view('articles_show', compact('id'));
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
