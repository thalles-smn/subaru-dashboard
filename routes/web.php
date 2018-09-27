<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts', 'PostsViewController@index')->name('posts.index');
Route::get('/posts/create', 'PostsViewController@create')->name('posts.create');
Route::post('/posts', 'PostsViewController@store')->name('posts.store');
Route::put('/posts/{id}', 'PostsViewController@update')->name('posts.update');
Route::get('/posts/{id}', 'PostsViewController@edit')->name('posts.edit');
Route::get('/posts/destroy/{id}', 'PostsViewController@destroy')->name('posts.destroy');
