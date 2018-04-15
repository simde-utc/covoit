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

    // Edit a Car
    public function displayEditCarForm($car_id){
      $CarObject = $this->DB->getCarFromId($car_id);
      new \EditCarFormPage($CarObject);
    }

    public function processEditCarForm(){

    }

    public function displayDeleteCarForm($request){
      $CarsObject = $this->DB->getCarsFromUserId($_SESSION["idUser"]);
      new \DeleteCarFormPage($CarsObject);
    }

    public function processDeleteCar($request){
        $result = $this->DB->DeleteCar($request->input('idCar'));
        echo $result;
    }

}
