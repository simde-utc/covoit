<?php

namespace App;

Route::get('/login', 'LoginController@index', 'isNotLogged');
Route::get('/login/process', 'LoginController@login', 'isNotLogged');
Route::get('/logout', 'LoginController@logout', 'isLogged');

// Routes for CarController
Route::get('/cars', 'CarController@displayCars', 'isLogged');
Route::get('/cars/add', 'CarController@displayAddCarForm', 'isLogged');
Route::post('/cars/add', 'CarController@processAddCar', 'isLogged');
Route::post('/cars/delete', 'CarController@processDeleteCar', 'isLogged');
Route::get('/cars/{id}', 'CarController@displayCar', 'isLogged');
Route::get('/cars/{id}/edit', 'CarController@displayEditCarForm', 'isLogged');
Route::post('/cars/{id}/edit', 'CarController@processEditCarForm', 'isLogged');

// Routes for RideController
Route::get('/rides', 'RideController@displayRides', 'isLogged');
Route::get('/rides/add', 'RideController@displayAddRideForm', 'isLogged');
Route::post('/rides/add', 'RideController@processAddRide', 'isLogged');
Route::post('/rides/delete', 'RideController@processDeleteRide', 'isLogged');
Route::get('/rides/join', 'RideController@displayJoinRides', 'isLogged');
Route::post('/rides/join', 'RideController@processJoinRide', 'isLogged');
Route::get('/rides/{id}', 'RideController@displayRide', 'isLogged');
Route::get('/myrides', 'RideController@displayJoinedRides', 'isLogged');




// Home
Route::get('/', 'HomeController@displayHome', 'isLogged');

echo 'PAS DE PAGE TROUVEE !!';
exit;
