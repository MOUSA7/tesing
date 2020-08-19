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
