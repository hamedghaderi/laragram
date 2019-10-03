<?php

Route::get('/posts', 'PostsController@index');
Route::post('/posts', 'PostsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
