<?php
namespace Controller;

require_once("View/RidePage.php");
require_once("View/AddRideFormPage.php");

use App\DB;

/**
 *
 */
class RideController
{
    /**
     *
     */
    public $DB;

    public function __construct()
    {
        $this->DB = new DB();
    }

    public function displayRide($request){
        $rideObject = $this->DB->getRideFromId($request->arg("id"));
        new \RidePage($rideObject);
    }
    public function displayAddRideForm(){
        $user_id=1;
        #TODO
        $carsObjet = $this->DB->getCarsFromUserId($user_id);
        new \AddRideFormPage($carsObjet);
    }

    public function displayEditRideForm($ride_id){
      $rideObject = $this->DB->getRideFromId($ride_id);
      //new EditRideForm($rideObject);
    }

    public function processAddRide($request){
        var_dump($request->allInputs());
        $this->DB->addRide($request->allInputs());
    }

    public function processEditRideForm(){

    }

}
