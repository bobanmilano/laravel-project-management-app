<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {

	// Route::get('/projects', 'ProjectsController@index');
	// Route::get('/projects/create', 'ProjectsController@create');
	// Route::post('/projects', 'ProjectsController@store');
	// Route::get('/projects/{project}', 'ProjectsController@show');
	// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
	// Route::delete('/projects/{project}', 'ProjectsController@destroy');
	// Route::patch('/projects/{project}', 'ProjectsController@update');

	Route::resource('/projects', 'ProjectsController');

	Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

	Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
	Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
	Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();

// 