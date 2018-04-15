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
        (new \RidePage($this->DB->getRideFromId($request->arg("id"))))->display();
    }
    
    public function displayAddRideForm(){
        (new \AddRideFormPage($this->DB->getCarsFromUserId($_SESSION["idUser"])))->display();
    }

    public function displayEditRideForm($ride_id){
      $rideObject = $this->DB->getRideFromId($ride_id);
      //new EditRideForm($rideObject);
    }
    private function getCoord($address){
        $r = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyDUbqoGhJJRPk6rt6bHG7_Q1c3OfDxL5So'), true);
        echo "<pre>";
        print_r($r['results'][0]);
        echo "</pre>";
        return $r['results'][0]['geometry']['location'];
    }

    private function getformattedaddress($address){
        $r = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyDUbqoGhJJRPk6rt6bHG7_Q1c3OfDxL5So'), true);
        echo "<pre>";
        print_r($r['results'][0]);
        echo "</pre>";
        return $r['results'][0]['formatted_address'];
    }
    public function processAddRide($request){
        $ride_info = $request->allInputs();
        $ride_info["steps"] = array();
        array_push($ride_info["steps"],array(
            "address"=>$this->getformattedaddress($ride_info["departure"]),
            "lat" => $this->getCoord($ride_info['departure'])['lat'],
            "lng" => $this->getCoord($ride_info['departure'])['lng'])
        );
        for($i = 0; $i<$ride_info["nb_step"];$i++){
            $address = $this->getformattedaddress($ride_info["step".$i]);
            $lat = $this->getCoord($ride_info["step".$i])["lat"];
            $lng = $this->getCoord($ride_info["step".$i])["lng"];
            array_push($ride_info["steps"], array(
                "address"=>$address,
                "lat" => $lat,
                "lng" => $lng));
        }

        array_push($ride_info["steps"],array(
            "address"=>$this->getformattedaddress($ride_info["arrival"]),
            "lat" => $this->getCoord($ride_info['arrival'])['lat'],
            "lng" => $this->getCoord($ride_info['arrival'])['lng'])
        );
        echo "<pre>";
        print_r($ride_info);
        echo "</pre>";
        $ride_info["departure"] = $this->getformattedaddress($ride_info["departure"]);
        $ride_info["arrival"] = $this->getformattedaddress($ride_info["arrival"]);
        $ride_info["departure_lat"] = $this->getCoord($ride_info['departure'])['lat'];
        $ride_info["departure_lng"] = $this->getCoord($ride_info['departure'])['lng'];
        $ride_info["arrival_lat"] = $this->getCoord($ride_info['arrival'])['lat'];
        $ride_info["arrival_lng"] = $this->getCoord($ride_info['arrival'])['lng'];
        $this->DB->addRide($ride_info);
    }

    public function processEditRideForm(){

    }

}
