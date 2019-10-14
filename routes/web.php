<?php

Route::get('/posts', 'PostsController@index')->middleware('auth');
Route::post('/posts', 'PostsController@store')->middleware('auth');
Route::delete('/posts/{post}', 'PostsController@destroy')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
