<?php

namespace App;

if (file_exists('.env'))
	require_once '.env';

session_start();

require_once 'Helpers.php';

if (env('DEBUG_MODE', false)) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
}

require_once 'DB.php';

require_once 'Model/Model.php';
require_once 'Model/User.php';
require_once 'Model/Car.php';
require_once 'Model/Ride.php';
require_once 'Model/Passager.php';


require_once "Route.php";
require_once "Request.php";

require_once 'routes/web.php';
