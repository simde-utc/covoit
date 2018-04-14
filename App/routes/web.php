<?php
	\App\Route::get('/', 'LoginController@index');
	\App\Route::get('/b/', 'LoginController@store');
	\App\Route::get('/login/{type}', 'LoginController@index');
