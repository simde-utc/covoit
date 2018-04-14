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
      $DAO->
      new EditRideForm();
    }

}
