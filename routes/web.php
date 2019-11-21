<?php

/**
 *      @author "Sunwarul Islam, Bangladesh"
 *  Free and Opensource Software Under MIT Licence
 *      Published Data: 14 November '19
 * ---------------------------------------------------
 */

Route::get('/', 'PagesController@index')->name('welcome');
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostController');
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('posts/{post}/restore', 'PostController@restore')->name('posts.restore');
    // Todo:: Restore All post from trash.
    // Route::get('/posts/restore-all', 'PostController@restore_all')->name('posts.restore_all');
    Route::resource('tags', 'TagController');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('users/{user}/make-writer', 'UsersController@makeWriter')->name('users.make-writer');
});
