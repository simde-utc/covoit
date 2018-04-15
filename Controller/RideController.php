<?php
namespace Controller;

require_once("View/RidePage.php");
require_once("View/AddRideFormPage.php");
require_once("Services/GoogleMaps.php");
require_once("View/DeleteRideFormPage.php");
require_once("View/JoinRideFormPage.php");


use Services\GoogleMaps;
use Model\Ride;
use Model\Car;
use Model\Passager;

/**
 *
 */
class RideController
{

    public function displayRides($request) {
      (new \DeleteRideFormPage(Ride::getFromUser()))->display();
    }

    public function displayJoinRides($request) {
      (new \JoinRideFormPage(Ride::getDifferentFromUser()))->display();
    }

    public function displayJoinedRides($request) {
      (new \DeleteRideFormPage(Passager::getJoinedFromUser()))->display();
    }

    public function displayRide($request){
      (new \RidePage(Ride::find($request->arg('id')), "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    public function displayAddRideForm(){
        (new \AddRideFormPage(Car::getFromUser()))->display();
    }

    public function displayEditRideForm($ride_id){
    	$ride = Ride::find($request->arg("id"));

		if ($ride->user_id !== $_SESSION['id'])
			throw new \Exception('Impossible de modifier une route qui ne t\'appartient pas !');
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
        //var_dump($ride_info);
        $created_date = date("Y-m-d H:i:s");
        $date = date("H:i:s");
        Ride::create($ride_info["car"], $ride_info["description"], $ride_info["nb_seats"], $ride_info["value_luggage"], $date, $created_date);
        //public static function create($car_id, $description, $nb_free_seats, $value_luggage, $date, $creation_date, $user_id = null) {

    }

    public function processEditRideForm(){

    }

    public function processDeleteRide($request){
        Ride::delete($request->input('id'));
    }

    public function processJoinRide($request){
        $creation_date = date("H:i:s");
        Passager::create($request->input('id'), $creation_date);
    }

}
