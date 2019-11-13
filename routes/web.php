<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostController');
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('posts/{post}/restore', 'PostController@restore')->name('posts.restore');
    // Todo:: Restore All post from trash.
    Route::get('/posts/restore-all', 'PostController@restore_all')->name('posts.restore_all');
    Route::resource('tags', 'TagController');
});
