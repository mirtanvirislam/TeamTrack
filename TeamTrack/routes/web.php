<?php

use App\Team;
use App\User;

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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// Data Routes
Route::get('/import_data','DataController@importData'); // import data
Route::get('/empty_data','DataController@emptyData'); // empty database

Route::get('/contact', 'PagesController@contact');
Route::get('/about', 'PagesController@about');

// Task Routes
Route::resource('tasks', 'TasksController');

// Team Routes
Route::get('teams','TeamsController@index');
Route::get('teams/{id}','TeamsController@show');
Route::get('teams/create','TeamsController@create');
// implement delete Team route and method
Route::get('teams/{id}/addMember','TeamsController@addMember');
// implement delete Member route and method




