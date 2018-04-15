<?php
namespace Controller;

require_once("View/RidePage.php");
require_once("View/AddRideFormPage.php");

use Model\Ride;
use Model\Car;

/**
 *
 */
class RideController
{
    public function displayRide($request){
        (new \RidePage(Ride::find($request->arg("id"))))->display();
    }

    public function displayAddRideForm(){
        new \AddRideFormPage(Car::getFromUser());
    }

    public function displayEditRideForm($ride_id){
    	$ride = Ride::find($request->arg("id"));

		if ($ride->user_id !== $_SESSION['id'])
			throw new \Exception('Impossible de modifier une route qui ne t\'appartient pas !');
      //new EditRideForm($rideObject);
    }

    public function processAddRide($request){
        Ride::create($request->allInputs());
    }

    public function processEditRideForm(){

    }

}
