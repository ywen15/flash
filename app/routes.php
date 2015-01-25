<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@home'));

/** API **/


/** Session **/
Route::get('login', 'SessionController@create');
Route::get('logout', 'SessionController@destroy');
Route::resource('session', 'SessionController', array('only' => array('store')));

/** User **/
Route::resource('user', 'UserController');

/** Project **/
Route::get('project/dataTable/{project_type?}', 'ProjectController@dataTable');
Route::get('billing', 'ProjectController@billing');
Route::get('archive', 'ProjectController@archive');
Route::get('project/{project_id}/reset', 'ProjectController@reset');
Route::get('project/{project_id}/complete', 'ProjectController@complete');
Route::get('project/{project_id}/bill', 'ProjectController@bill');
Route::get('project/modal/{project_id}/{type}', 'ProjectController@modal');
Route::resource('project', 'ProjectController');