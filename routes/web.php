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
// DEFAULT WELCOME PAGE
/*
Route::get('/', function () {
    return view('welcome');
}); */

// INDEX PAGE

Route::get('/', 'PagesController@index');

// ABOUT PAGE
Route::get('/about', 'PagesController@about');

// TASK MAIN PAGE
Route::get('/tasks', 'PagesController@tasks');

// INDIVIDUAL TASK VIEW PAGE
Route::get('/task', 'PagesController@task');

// TASK EDIT PAGE
Route::get('/edit', 'PagesController@edit');

//Generate the routes for TasksController
Route::resource('tasks', 'TasksController');

//Generate the routes for TasksController
Route::resource('priorities', 'PrioritiesController');

//Generate the routes for TasksController
Route::resource('plists', 'PListsController');

