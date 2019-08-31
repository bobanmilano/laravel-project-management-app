<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/projects', 'ProjectsController@index');
	Route::get('/projects/create', 'ProjectsController@create');
	Route::post('/projects', 'ProjectsController@store');
	Route::get('/projects/{project}', 'ProjectsController@show');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
});

Auth::routes();

