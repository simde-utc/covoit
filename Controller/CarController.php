<?php

namespace Controller;

require_once("DAO.php");
require_once("View/CarPage.php");
require_once("View/AddCarFormPage.php");
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

    public function displayCar($request){
        $CarObject = $this->DAO->getCarFromId($request->arg('id'));
        echo $CarObject["model"];
        new EditRideForm($rideObject);
    }

    public function displayAddCarForm(){
        new \AddCarFormPage();
        //$carsObjet = $this->DAO->getCarsFromUserId($user_id);
        //new \AddRideFormPage($carsObjet);
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
