<?php
	require_once "App/Route.php";
	require_once "App/Request.php";
	require_once "Controller/LoginController.php";

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	\App\Route::get('/', '');
	\App\Route::get('/b/', 'LoginController@store');
	\App\Route::get('/{a}/', 'LoginController@index');
