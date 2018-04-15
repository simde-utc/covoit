<?php

namespace Controller;

require_once("View/CarPage.php");
require_once("View/Page.php");
require_once("View/AddCarFormPage.php");
require_once("View/EditCarFormPage.php");
require_once("View/DeleteCarFormPage.php");

use App\DB;

/**
 *
 */
class CarController
{
    /**
     *
     */
    public $DB;

    public function __construct()
    {
        $this->DB = new DB();
    }

	public function displayCars($request){
	  $CarsObject = $this->DB->getCarsFromUserId($_SESSION["idUser"]);
	  new \DeleteCarFormPage($CarsObject);
	}

    // Show a Car
    public function displayCar($request){
        (new \CarPage($this->DB->getCarFromId($request->arg('id')), "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    // Add a Car
    public function displayAddCarForm(){
        (new \AddCarFormPage())->display();
    }

    public function processAddCar($request){
      $this->DB->addCar($request);
    }


    public function displayEditCarForm($request){
        (new \EditCarFormPage($this->DB->getCarFromId($request->arg('id')), "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    public function processEditCarForm(){

    }

    public function processDeleteCar($request){
        $result = $this->DB->DeleteCar($request->input('idCar'));
        echo $result;
    }

}
