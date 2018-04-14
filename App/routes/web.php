<?php

namespace App;

Route::get('/', 'ControllerBidon@index', 'isLogged');
Route::get('/b/', 'LoginController@store');
Route::get('/login/{type}', 'LoginController@index');
