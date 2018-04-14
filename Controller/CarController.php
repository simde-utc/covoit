<?php

namespace Controller;

require_once("DAO.php");
require_once("View/CarPage.php");
require_once("View/Page.php");
require_once("View/AddCarFormPage.php");
require_once("View/EditCarFormPage.php");



class CarController
{

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
        $result = $this->DAO->addCar($request->input('type'));
    }

    public function displayEditCarForm($request){
      $CarObject = $this->DAO->getCarFromId($request->arg('id'));
      new \EditCarFormPage($CarObject);
    }

    public function processEditCarForm($request){
      $content = array("model" => $request->input('model'),
                    "color" => $request->input('color'),
                    "nb_seats" => $request->input('nb_seats'),
                    "owner" => 1,
                    "idCar" => $request->input('idCar'),
      );
      $result = $this->DAO->UpdateCar($content);
    }
}
