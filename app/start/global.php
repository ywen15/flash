<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

HTML::macro('span', function($value, $attributes)
{
	return sprintf('<span %s>%s</span>', HTML::attributes($attributes), $value);
});

HTML::macro('btnDelete', function($component, $id)
{
	return html_entity_decode( link_to(route($component.'.destroy', $id), HTML::span(null, array('class' => 'glyphicon glyphicon-trash')), array('class' => 'btn btn-sm btn-danger projectModal', 'data-toggle' => 'modal', 'data-target' => '#projectModal', 'data-project' => $id, 'data-action' => 'destroy')) );
});

HTML::macro('btnEdit', function($component, $id)
{
	return html_entity_decode( link_to(route($component.'.edit', $id), HTML::span(null, array('class' => 'glyphicon glyphicon-pencil')), array('class' => 'btn btn-sm btn-primary')) );
});

HTML::macro('btnReschedule', function($component, $id)
{
	return html_entity_decode( link_to($component.'/'.$id.'/reset', HTML::span(null, array('class' => 'glyphicon glyphicon-arrow-left')), array('class' => 'btn btn-sm btn-success projectModal', 'data-toggle' => 'modal', 'data-target' => '#projectModal', 'data-project' => $id, 'data-action' => 'reset')) );
});

HTML::macro('btnComplete', function($component, $id)
{
	return html_entity_decode( link_to($component.'/'.$id.'/complete', HTML::span(null, array('class' => 'glyphicon glyphicon-ok')), array('class' => 'btn btn-sm btn-success projectModal', 'data-toggle' => 'modal', 'data-target' => '#projectModal', 'data-project' => $id, 'data-action' => 'complete')) );
});

HTML::macro('btnBill', function($component, $id)
{
	return html_entity_decode( link_to($component.'/'.$id.'/bill', HTML::span(null, array('class' => 'glyphicon glyphicon-usd')), array('class' => 'btn btn-sm btn-warning projectModal', 'data-toggle' => 'modal', 'data-target' => '#projectModal', 'data-project' => $id, 'data-action' => 'bill')) );
});

HTML::macro('btnSchedule', function($id, $state)
{
	$icon = ($state) ? HTML::image('images/on_schedule.png') : HTML::image('images/off_schedule.png');
	return html_entity_decode( link_to('project/'.$id.'/schedule', $icon, array('class' => 'btn btn-default btn-sm projectModal', 'data-toggle' => 'modal', 'data-target' => '#projectModal', 'data-project' => $id, 'data-action' => 'schedule')) );
});