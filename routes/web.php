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

Route::get('/login', 'CleanderController@login');
Route::post('/loginValidate', 'CleanderController@loginValidate')->name("loginValidate");
Route::get('/register', 'CleanderController@register')->name("util.register");
Route::get('/reset', 'CleanderController@reset');
Route::get('/resetForm', 'CleanderController@resetForm');

Route::get('/timeline', 'CleanderController@timeline');
Route::get('/newPost', 'CleanderController@newPost');
Route::get('/likedPost', 'CleanderController@likedPost');
Route::get('/sharePost', 'CleanderController@sharePost');
Route::get('/userPost', 'CleanderController@userPost');
Route::get('/PostUplode', 'CleanderController@PostUplode');

Route::get('/newTask', 'CleanderController@newTask');
Route::get('/userTask', 'CleanderController@userTask');
Route::get('/taskZoom', 'CleanderController@taskZoom');

Route::get('/users', 'CleanderController@showUsers');

