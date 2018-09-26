<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource("posts", "PostsController");
Route::resource("photos", "PhotoController");
Route::post("photos/{postId}", "PhotoController@upload");
Route::get("posts/photos/{id}", "PostsController@photos");
