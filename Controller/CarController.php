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
        $rideObject = $this->DAO->getCarFromId($id);
        echo $rideObject["model"];
    }

    public function displayAddCarForm(){
        new AddRideForm();
    }

    public function displayEditCarForm($ride_id){
      $rideObject = $DAO->getCarFromId(id);
      //new EditRideForm($rideObject);
    }

    public function processAddRide(){

    }

    public function processEditRideForm(){

    }
}
