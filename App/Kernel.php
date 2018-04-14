<?php

namespace App;

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once "App/Route.php";
require_once "App/Request.php";

require_once 'Helpers.php';
require_once 'routes/web.php';
