<?php

namespace Controller;

require_once("View/HomePage.php");
require_once("View/Page.php");

use App\DB;


class HomeController
{

    public function __construct()
    {
    }

	public function displayHome($request){
	  (new \HomePage())->display();
	}

}
