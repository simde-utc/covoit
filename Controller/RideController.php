<?php
namespace Controller;
require_once("App/DB.php");
require_once("View/RidePage.php");
require_once("View/AddRideFormPage.php");


/**
 *
 */
class RideController
{
    /**
     *
     */
    public $DAO;

    public function __construct()
    {
        $this->DAO = new DAO();
    }

    public function displayRide($request){
        $rideObject = $this->DAO->getRideFromId($request->arg("id"));
        new \RidePage($rideObject);
    }
    public function displayAddRideForm(){
        $user_id=1;
        #TODO
        $carsObjet = $this->DAO->getCarsFromUserId($user_id);
        new \AddRideFormPage($carsObjet);
    }

    public function displayEditRideForm($ride_id){
      $rideObject = $this->DAO->getRideFromId($ride_id);
      //new EditRideForm($rideObject);
    }

    public function processAddRide($request){
        var_dump($request->allInputs());
        $this->DAO->addRide($request->allInputs());
    }

    public function processEditRideForm(){

    }

}
