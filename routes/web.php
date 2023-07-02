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
Route::get('/', 'CleanderController@login');
Route::get('/logout', 'CleanderController@logout');
Route::get('/login', 'CleanderController@login');
Route::post('/login', 'CleanderController@loginValidate')->name("loginValidate");
Route::get('/register', 'CleanderController@register')->name("register");
Route::post('/register', 'CleanderController@registerValidate')->name("registerValidate");
Route::get('/reset', 'CleanderController@reset');
Route::post('/reset', 'CleanderController@resetValidate')->name('resetValidate');
Route::get('/resetForm', 'CleanderController@resetForm');
Route::post('/resetSend', 'CleanderController@resetPost')->name('resetPost');;
Route::get('/users', 'CleanderController@showUsers')->middleware('login');
Route::post('/userDelete', 'CleanderController@userDelete')->middleware('login');

Route::get('/timeline', 'PostController@timeline')->middleware('login');
Route::post('/like', 'PostController@like')->middleware('login');
Route::post('/postDelete', 'PostController@postDelete')->middleware('login')->name('postDelete');
Route::get('/newPost', 'PostController@newPost')->middleware('login');
Route::post('/newPost', 'PostController@postValidate')->middleware('login')->name('postValidate');
Route::get('/likedPost', 'PostController@likedPost')->middleware('login');
Route::get('/sharePost', 'PostController@sharePost');
Route::get('/userPost', 'PostController@userPost')->middleware('login');
Route::get('/postUplode', 'PostController@postUplode')->middleware('login');

Route::get('/newTask', 'TaskController@newTask')->middleware('login');
Route::post('/newTask', 'TaskController@taskValidate')->middleware('login')->name('taskValidate');
Route::get('/task', 'TaskController@task')->middleware('login');
Route::post('/taskrun', 'TaskController@taskRun')->middleware('login');
Route::get('/taskZoom', 'TaskController@taskZoom')->middleware('login')->name('zoom');
Route::post('/taskZoomUp', 'TaskController@taskUpValidate')->name('taskUpValidate');
Route::get('/taskDelete', 'TaskController@taskDelete')->middleware('login')->name('task.delete');
