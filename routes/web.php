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

Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('google.login');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::view('/', 'pages.index')->name('home');
Route::view('/about', 'pages.about')->name('about');

Route::get('tasks/deleted', 'TasksController@deleted');
Route::resource('tasks', 'TasksController');
Route::resource('priorities', 'PrioritiesController');
