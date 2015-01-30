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

// Session Routes
Route::get('login',  array('as' => 'login', 'uses' => 'SessionController@create'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionController@destroy'));
Route::resource('sessions', 'SessionController', array('only' => array('create', 'store', 'destroy')));

// User Routes
Route::get('register', 'UserController@create');
Route::post('signup', 'UserController@signup');
Route::get('users/{id}/activate/{code}', 'UserController@activate')->where('id', '[0-9]+');
Route::get('resend', array('as' => 'resendActivationForm', function()
{
	return View::make('users.resend');
}));
Route::post('resend', 'UserController@resend');
Route::get('forgot', array('as' => 'forgotPasswordForm', function()
{
	return View::make('users.forgot');
}));
Route::post('forgot', 'UserController@forgot');
Route::post('users/{id}/change', 'UserController@change');
Route::get('users/{id}/reset/{code}', 'UserController@reset')->where('id', '[0-9]+');
Route::get('users/{id}/suspend', array('as' => 'suspendUserForm', function($id)
{
	return View::make('users.suspend')->with('id', $id);
}));
Route::post('users/{id}/suspend', 'UserController@suspend')->where('id', '[0-9]+');
Route::get('users/{id}/unsuspend', 'UserController@unsuspend')->where('id', '[0-9]+');
Route::get('users/{id}/ban', 'UserController@ban')->where('id', '[0-9]+');
Route::get('users/{id}/unban', 'UserController@unban')->where('id', '[0-9]+');
Route::get('users/{id}/getinfo', 'UserController@getInfo');
Route::get('users/{id}/destroy', 'UserController@destroy');
Route::resource('users', 'UserController');


Route::get('admin/upload/customers', 'UploadController@customers');
Route::post('admin/upload/customers/submit', 'UploadController@uploadCustomers');
Route::get('admin/upload/users', 'UploadController@users');
Route::post('admin/upload/users/submit', 'UploadController@uploadUsers');
Route::get('admin/processes', 'AdminController@processes');
Route::post('admin/processes/save', 'AdminController@saveProcesses');


/** User **/
Route::resource('user', 'UserController');

/** Process **/
Route::get('process/{process_id}/getEquipmentList', 'ProcessController@getEquipmentList');
Route::get('process/{process_id}/weekelyTask', 'ProcessController@weekelyTask');

/** Project **/
Route::get('project/dataTable/{project_type?}', 'ProjectController@dataTable');
Route::get('billing', 'ProjectController@billing');
Route::get('archive', 'ProjectController@archive');

Route::get('project/{project_id}/timeline', 'ProjectController@timeline');
Route::get('project/{project_id}/reset', 'ProjectController@reset');
Route::get('project/{project_id}/complete', 'ProjectController@complete');
Route::get('project/{project_id}/bill', 'ProjectController@bill');
Route::get('project/{project_id}/schedule', 'ProjectController@schedule');

Route::post('project/{project_id}/saveDueDate', 'ProjectController@saveDueDate');
Route::post('project/{project_id}/saveNotes', 'ProjectController@saveNotes');

Route::get('project/modal/{project_id}/{type}', 'ProjectController@modal');
Route::resource('project', 'ProjectController');

/** Task **/
Route::post('process/{process_id}/taskByDate', 'TaskController@taskByDate');
Route::get('scheduler/{process_name?}', 'TaskController@scheduler');
Route::get('task/{task_id}/reschedule', 'TaskController@reschedule');
Route::post('task/{task_id}/saveStatus', 'TaskController@saveStatus');
Route::resource('task', 'TaskController');