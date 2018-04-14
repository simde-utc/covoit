<?php
require_once("functions.php");
	require_once "App/Route.php";
	require_once "App/Request.php";
	require_once "Controller/LoginController.php";

$p = new CarPage("mon_titre", "mon_auteur", "ma_description");
$p->appendHeader("Header");
$p->appendContent("Content");
$p->appendFooter("Footer");
$p->display();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	\App\Route::get('/', 'LoginController@index');
	\App\Route::get('/b/', 'LoginController@store');
	\App\Route::get('/login/{type}', 'LoginController@index');
