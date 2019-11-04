<?php

Route::get('/posts', 'PostsController@index')->middleware('auth');
Route::post('/posts', 'PostsController@store')->middleware('auth');
Route::delete('/posts/{post}', 'PostsController@destroy')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/members/{user}', 'FollowingsController@store');
Route::post('/followers/{user}/decline', 'FollowersController@destroy');
Route::post('/followers/{user}/accept', 'FollowersController@store');
Route::post('/following/{user}/cancel', 'FollowingsController@destroy');

Route::get('/users/{user}', 'PanelsController@show');
Route::patch('/users/{user}/username', 'UsernameController@update');
Route::get('/users/search', 'SearchController@show');

Route::view('search', 'search');
