<?php

namespace App;

Route::get('/login', 'LoginController@index', 'isNotLogged');
Route::get('/login/process', 'LoginController@login', 'isNotLogged');
Route::get('/logout', 'LoginController@logout', 'isLogged');

// Routes for CarController
Route::get('/cars', 'CarController@displayCars', 'isLogged');
Route::get('/cars/add', 'CarController@displayAddCarForm', 'isLogged');
Route::post('/cars/add', 'CarController@processAddCar', 'isLogged');
Route::get('/cars/{id}', 'CarController@displayCar', 'isLogged');
Route::get('/cars/{id}/edit', 'CarController@displayEditCarForm', 'isLogged');
Route::post('/cars/{id}/edit', 'CarController@processEditCarForm', 'isLogged');
Route::get('/cars/{id}/delete', 'CarController@processDeleteCar', 'isLogged');

// Routes for RideController
Route::get('/rides/add', 'RideController@displayAddRideForm', 'isLogged');
Route::post('/rides/add', 'RideController@processAddRide', 'isLogged');
Route::get('/rides/{id}', 'RideController@displayRide', 'isLogged');

require_once "Model/Car.php";

print_r(\Model\Car::getCarsOfUser(1));

echo 'PAS DE PAGE TROUVEE !!';
exit;
