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
Route::post('/ajaxRequest', function () {
    //return response()->json(array('msg'=>'yoyoyo'),200);
    return response()->json(['success'=>'Got Simple Ajax Request.']);
});

// Task Routes
Route::resource('tasks', 'TasksController');
//Route::get('tasks/create/{sprintId}','TasksController@create');
Route::post('tasks','TasksController@store');
Route::post('tasks/create','TasksController@store');

// Sprint Routes
Route::resource('sprints', 'SprintsController');

// Members Routes
Route::resource('members', 'MembersController');

// Comments Routes
Route::resource('comments', 'CommentsController');

// Team Routes
//Route::get('teams','TeamsController@index');

Route::get('teamsmasterindex','TeamsController@masterindex');
Route::get('teams/create','TeamsController@create');
Route::get('teams/{id}','TeamsController@show'); // Team deshboard page - currents shows member list
Route::get('teams','TeamsController@index');
Route::get('tasks','TasksController@index');
// implement delete Team route and method
//Route::get('teams/members/{id}','TeamsController@members'); // Show members in team + add/delete member option
// implement delete Member route and method
Route::post('teams','TeamsController@store');   // required for post actions
//Route::post('teams/members','TeamsController@storeMember');   // required for post actions
Route::delete('teams/{id}','TeamsController@destroy'); 


# Socialite
Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider1');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback1');