<?php

namespace Controller;

require_once("View/CarPage.php");
require_once("View/Page.php");
require_once("View/AddCarFormPage.php");
require_once("View/EditCarFormPage.php");
require_once("View/DeleteCarFormPage.php");

require_once 'Model/Car.php';

use App\Route;
use Model\Car;

/**
 *
 */
class CarController
{

	public function displayCars($request) {
		(new \DeleteCarFormPage(Car::getFromUser()))->display();
	}

    // Show a Car
    public function displayCar($request) {
        (new \CarPage(Car::find($request->arg('id')), "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    // Add a Car
    public function displayAddCarForm() {
        (new \AddCarFormPage())->display();
    }

    public function processAddCar($request) {
    	Car::create(
			$request->input('model'),
			$request->input('color'),
			$request->input('nb_seats')
		);
    }


    public function displayEditCarForm($request) {
		$car = Car::find($request->arg('id'));

		if ($cars->user_id !== $_SESSION['id'])
			throw new \Exception('Impossible de modifier une voiture qui ne t\'appartient pas !');

        (new \EditCarFormPage($car, "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    public function processEditCarForm(){

    }

    public function displayDeleteCarForm($request){
        (new \DeleteCarFormPage($this->DB->getCarFromId($_SESSION['idUser']), "mon_titre", "mon_auteur", "ma_description"))->display();
    }

    public function processDeleteCar($request){
        Car::delete($request->input('id'));
    }

}
