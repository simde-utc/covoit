<?php

namespace Controller;

require_once("DAO.php");
/**
 *
 */
class CarController
{
    /**
     *
     */
    public $DAO;

    public function __construct()
    {
        $this->DAO = new DAO();
    }

    public function displayCar($id){
        $CarObject = $this->DAO->getCarFromId($id);
        $rideObject = $DAO->getRideFromId(id);
        new EditRideForm($rideObject);
    }

    public function displayAddCarForm(){
        new AddCarForm();
    }

    public function processAddCar($content){
        $result = $this->DAO->addCar($content);
    }

    public function displayEditCarForm($car_id){
      $CarObject = $this->DAO->getCarFromId($car_id);
      new EditCarForm($CarObject);
    }



    public function processEditCarForm(){

    }
}
