<?php
namespace Controller;

require_once("View/RidePage.php");
require_once("View/AddRideFormPage.php");
require_once("Services/GoogleMaps.php");

use App\DB;
use Services\GoogleMaps;

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
        $user_id=1;
        #TODO
        $carsObjet = $this->DB->getCarsFromUserId($user_id);
        new \AddRideFormPage($carsObjet);
    }

    public function displayEditRideForm($ride_id){
      $rideObject = $this->DB->getRideFromId($ride_id);
      //new EditRideForm($rideObject);
    }
    private function getCoord($address){
        $r = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyDUbqoGhJJRPk6rt6bHG7_Q1c3OfDxL5So'), true);

        return $r['results'][0]['geometry']['location'];
    }
    private function get_step_duration($address1, $address2){
        $map = new GoogleMaps();
        $json = $map->ride($address1, $address2);
        echo "<pre>";
        print_r($json);
        echo "</pre>";
        return $json["rows"][0]["elements"][0]["duration"]["value"];
    }
    private function get_step_distance($address1, $address2){
        $map = new GoogleMaps();
        $json = $map->ride($address1, $address2);
        echo "<pre>";
        print_r($json);
        echo "</pre>";
        return $json["rows"][0]["elements"][0]["distance"]["value"];
    }
    private function getformattedaddress($address){
        $r = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyDUbqoGhJJRPk6rt6bHG7_Q1c3OfDxL5So'), true);

        return $r['results'][0]['formatted_address'];
    }
    public function processAddRide($request){
        $ride_info = $request->allInputs();
        $cities = array();
        $ride_info["steps"] = array();
        array_push($cities,array(
            "address"=>$this->getformattedaddress($ride_info["departure"]),
            "lat" => $this->getCoord($ride_info['departure'])['lat'],
            "lng" => $this->getCoord($ride_info['departure'])['lng'])
        );
        for($i = 0; $i<$ride_info["nb_step"];$i++){
            $address = $this->getformattedaddress($ride_info["step".$i]);
            $lat = $this->getCoord($ride_info["step".$i])["lat"];
            $lng = $this->getCoord($ride_info["step".$i])["lng"];
            array_push($cities, array(
                "address"=>$address,
                "lat" => $lat,
                "lng" => $lng));
        }

        array_push($cities,array(
            "address"=>$this->getformattedaddress($ride_info["arrival"]),
            "lat" => $this->getCoord($ride_info['arrival'])['lat'],
            "lng" => $this->getCoord($ride_info['arrival'])['lng'])
        );

        for($i = 0; $i<count($cities)-1;$i++){
            array_push($ride_info["steps"], array(
                "departure" => $cities[$i],
               "arrival" => $cities[$i+1],
               "duration" => $this->get_step_duration($cities[$i]["address"], $cities[$i+1]["address"]),
               "distance" => $this->get_step_distance($cities[$i]["address"], $cities[$i+1]["address"])));
        }
        $this->DB->addRide($ride_info);
    }

    public function processEditRideForm(){

    }

}
