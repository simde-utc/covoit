<?php

namespace App;

Route::get('/', 'ControllerBidon@index', 'isLogged');
Route::get('/b/', 'LoginController@store');
Route::get('/login/{type}', 'LoginController@index');
Route::get('/ride/{id}', 'RideController@displayRide');
Route::get('/addride', 'RideController@displayAddRideForm');
