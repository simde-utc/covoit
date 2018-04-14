<?php

namespace Controller;

require_once("DAO.php");
require_once("View/CarPage.php");
require_once("View/Page.php");
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
        new \CarPage($CarObject);
    }

    public function displayAddCarForm(){
        new \AddCarFormPage();
    }

    public function processAddCar($request){
        // echo $request->input('all');
        // Ajout du userID
        $result = $this->DAO->addCar($request->input('type'));
    }

    public function displayEditCarForm($car_id){
      $CarObject = $this->DAO->getCarFromId($car_id);
      new EditCarForm($CarObject);
    }



    public function processEditCarForm(){

    }
}
