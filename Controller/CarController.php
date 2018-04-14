<?php

namespace Controller;

require_once("View/CarPage.php");
require_once("View/Page.php");
require_once("View/AddCarFormPage.php");

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

    public function displayCar($request){
        (new \CarPage($this->DB->getCarFromId($request->arg('id')), "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    public function displayAddCarForm(){
        (new \AddCarFormPage())->display();
    }

    public function processAddCar($request){
        // echo $request->input('all');
        // Ajout du userID
        $result = $this->DB->addCar($request->input('type'));
    }

    public function displayEditCarForm($car_id){
      $CarObject = $this->DB->getCarFromId($car_id);
      new EditCarForm($CarObject);
    }



    public function processEditCarForm(){

    }
}
