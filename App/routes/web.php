<?php

namespace App;

Route::get('/login', 'LoginController@index');
Route::get('/login/process', 'LoginController@login');
Route::get('/logout', 'LoginController@logout', 'isLogged');
Route::get('/ride/{id}', 'RideController@displayRide', 'isLogged');
Route::get('/addride', 'RideController@displayAddRideForm', 'isLogged');
Route::post('/submitRide', 'RideController@processAddRide', 'isLogged');

echo 'PAS DE PAGE TROUVEE !!';
exit;
