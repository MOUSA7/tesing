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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/student','StudentController@index');
Route::get('/student/scope','StudentController@scope');
Route::get('/student/access','StudentController@access');
Route::get('/student/mutators','StudentController@mutators_read');
Route::get('/student/mutators/store','StudentController@mutators_store');

Route::get('posts', 'PostsController@index')->name('posts');
Route::get('posts/show/{post}', 'PostsController@show')->name('posts.show');
Route::get('posts/create', 'PostsController@create')->name('posts.create');
Route::post('posts/create', 'PostsController@store')->name('posts.store');
Route::get('posts/edit/{id}', 'PostsController@edit')->name('posts.edit');
Route::patch('posts/edit/{id}', 'PostsController@update')->name('posts.update');
Route::get('posts/delete/{id}', 'PostsController@destroy')->name('posts.destroy');

Route::get('contact', 'PostsController@contact')->name('contact');

Route::get('/posts/tag/{id}','TagsController@index')->name('posts.tags.index');

Route::resource('posts.comments','PostsCommentController')->only('store','index');
Route::resource('users.comments','UsersCommentController')->only('store');
Route::resource('users','UsersController')->only('show','edit','update');
Route::get('secret', 'PostsController@secret')->name('secret')->middleware('can:secret-data');
//OR
//Route::DELETE('posts/delete/{id}','PostsController@destroy')->name('posts.destroy');
