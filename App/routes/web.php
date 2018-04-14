<?php

namespace App;

Route::get('/login', 'LoginController@index');
Route::get('/login/process', 'LoginController@login');
Route::get('/logout', 'LoginController@logout', 'isLogged');
Route::get('/ride/{id}', 'RideController@displayRide', 'isLogged');
Route::get('/addride', 'RideController@displayAddRideForm', 'isLogged');
Route::post('/submitRide', 'RideController@processAddRide', 'isLogged');

// Routes for CarController
Route::get('/addcar', 'CarController@displayAddCarForm', 'isLogged');
Route::post('/submitCar', 'CarController@processAddCar', 'isLogged');
Route::get('/car/view/{id}', 'CarController@displayCar');
Route::get('/editCar/{id}', 'CarController@displayEditCarForm', 'isLogged');
Route::post('/editCar/editCar', 'CarController@processEditCarForm', 'isLogged');

echo 'PAS DE PAGE TROUVEE !!';
exit;
