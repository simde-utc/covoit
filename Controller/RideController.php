<?php
namespace Controller;
require_once("DAO.php");


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

    public function displayRide($ride_id){
        $rideObject = $this->DAO->getRideFromId($ride_id);
    }
    public function displayAddRideForm($ride_id){
        $rideObject = $this->DAO->getRideFromId($ride_id);
        //new AddRideForm();
    }

    public function displayEditRideForm($ride_id){
      $rideObject = $this->DAO->getRideFromId($ride_id);
      //new EditRideForm($rideObject);
    }

    public function processAddRide(){

    }

    public function processEditRideForm(){

    }

}
