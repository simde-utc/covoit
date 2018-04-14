<?php

namespace App;

Route::get('/', 'LoginController@index');
Route::get('/b/', 'LoginController@store');
Route::get('/login/{type}', 'LoginController@index');
