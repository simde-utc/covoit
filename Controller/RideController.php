<?php

namespace Controller;

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
        $DAO = new DAO();
    }

    public function displayAddRideForm(){
        new AddRideForm();
    }

    public function displayEditRideForm($ride_id){
      $rideObject = $DAO->getRideFromId(id);
      new EditRideForm($rideObject);
    }

    public function processAddRide(){

    }

    public function processEditRideForm(){

    }

}
