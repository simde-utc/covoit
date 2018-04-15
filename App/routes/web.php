<?php

namespace App;

Route::get('/login', 'LoginController@index', 'isNotLogged');
Route::get('/login/process', 'LoginController@login', 'isNotLogged');
Route::get('/logout', 'LoginController@logout', 'isLogged');
Route::get('/ride/{id}', 'RideController@displayRide', 'isLogged');
Route::get('/addride', 'RideController@displayAddRideForm', 'isLogged');
Route::post('/submitRide', 'RideController@processAddRide', 'isLogged');

// Routes for CarController
Route::get('/addcar', 'CarController@displayAddCarForm', 'isLogged');
Route::post('/submitCar', 'CarController@processAddCar', 'isLogged');
Route::get('/car/view/{id}', 'CarController@displayCar', 'isLogged');
Route::get('/editCar/{id}', 'CarController@displayEditCarForm', 'isLogged');
Route::post('/editCar/editCar', 'CarController@processEditCarForm', 'isLogged');
Route::post('/deleteCar', 'CarController@processDeleteCar', 'isLogged');
Route::get('/deleteCar', 'CarController@displayDeleteCarForm', 'isLogged');




// Routes for RideController
Route::get('/ride/view/{id}', 'RideController@displayRide', 'isLogged');

echo 'PAS DE PAGE TROUVEE !!';
exit;
