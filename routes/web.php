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
    return view('front.index');
});

Auth::routes();
Route::get('/reload-captcha', [App\Http\Controllers\Auth\RegisterController::class, 'reloadCaptcha']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => '\App\Http\Controllers'], function () {
    Route::get('/posts', 'PostController@index')->name('posts');
    Route::get('posts/create', 'PostController@create')->name('post.create');
    Route::post('posts/create', 'PostController@store')->name('post.store');
    Route::get('/posts/{post}', 'PostController@show')->name('post.show');

    Route::get('/article/{post:slug}', 'PostController@show')->name('post.show-slug');

    Route::post('/comments/store', 'CommentController@store')->name('comment.add');
    Route::post('/comments/reply/store', 'CommentController@replyStore')->name('reply.add');
});
