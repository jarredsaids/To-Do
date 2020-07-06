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
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::view('/', 'pages.index')->name('home');
Route::view('/about', 'pages.about')->name('about');

Route::group(['middleware' => 'auth'], function () {
    Route::get('tasks/filter-by/{priority?}', 'TasksController@index')->name('tasks.filter-by');
    Route::resource('tasks', 'TasksController');
    Route::resource('priorities', 'PrioritiesController');
});


