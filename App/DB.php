<?php

namespace App;

use Model\Ride;

class DB extends \PDO
{
	public function __construct()
	{
		$config = config('db');

		parent::__construct("mysql:host=".$config['host'].";dbname=".$config['name'], $config['user'], $config['password'], [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
		]);
	}

	public function request($request, $params, $onlyOne = false) {
		$query = $this->prepare($request);
		$query->execute($params);

		if ($query->rowCount() !== 0) {
			try {
				return ($onlyOne ? $query->fetch() : $query->fetchAll()) ?? null;
			}
			catch (\Exception $e) {}
		}
		return null;
	}

	public function createOrGetUser($login, $lastname = null, $firstname = null, $email = null) {
		$query = $this->connexion->prepare("SELECT * FROM User WHERE login = :login");
		$query->execute(array(
			"login" => $login
		));

		if ($query->rowCount() === 0) {
			$query = $this->connexion->prepare(
				"INSERT INTO User(nom, prenom, login, eco_result, mail) VALUES(:lastname, :firstname, :login, 0, :email);"
			);
			$query->execute(array(
				"login" => $login,
				"lastname" => $lastname,
				"firstname" => $firstname,
				"email" => $email,
			));

            return $this->createOrGetUser($login);
		}
        else
		    return $query->fetch();
	}

    public function getRideFromId($id){
        try{
            $statement = $this->connexion->prepare("SELECT * FROM ride WHERE idRide = :id;");
            $statement->execute(array(
                "id" => $id
            ));
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;

        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème avec la table partie");
        }

    }

    public function getCarFromId($id){
        try{
            $statement = $this->connexion->prepare("SELECT * FROM Car WHERE idCar = :id;");
            $statement->execute(array(
                "id" => $id
            ));
            $result=$statement->fetch(\PDO::FETCH_ASSOC);
            return($result);
        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème avec la table Car");
        }

    }

    public function addCar($request){
        try{
            $statement = $this->connexion->prepare("INSERT INTO Car VALUES (NULL,:model,:color,:nb_seats,:owner);");
            $statement->execute(array(
                "model" => $request->input('model'),
                "color" => $request->input('color'),
                "nb_seats" => $request->input('nb_seats'),
                "owner" => $_SESSION["idUser"],
            ));
            //$result=$statement->fetch(\PDO::FETCH_ASSOC);
            //return($result);
        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème d'insertion dans la table Car");
        }

    }
    public function addRide($inputs){
        try{
            $id = uniqid();
            $statement = $this->connexion->prepare("INSERT INTO Ride VALUES (:id,:description,:nb_free_seats,:value_luggage,:car,:user_id, NOW());");
            $statement->execute(array(
                "id" => $id,
                "description" => $inputs["description"],
                "nb_free_seats" => $inputs["nb_free_seats"],
                "value_luggage" => $inputs["value_luggage"],
                "car" => $inputs["car"],
                "user_id" => $_SESSION["idUser"]
            ));

            $dep_id = uniqid();
            $statement = $this->connexion->prepare("INSERT INTO Place VALUES (:id,:text_address,:description,:lat,:lng);");
            $statement->execute(array(
                "id" => $dep_id,
                "text_address" => $inputs["departure"],
                "description" => "",
                "lat" => $inputs["departure_lat"],
                "lng" => $inputs["departure_lng"]
            ));

            $arr_id = uniqid();
            $statement = $this->connexion->prepare("INSERT INTO Place VALUES (:id,:text_address,:description,:lat,:lng);");
            $statement->execute(array(
                "id" => $arr_id,
                "text_address" => $inputs["arrival"],
                "description" => "",
                "lat" => $inputs["arrival_lat"],
                "lng" => $inputs["arrival_lng"]
            ));

            $statement = $this->connexion->prepare("INSERT INTO Step VALUES (UUID(),:distance,:departure_time,:eco_result,:duration, :description, :departure, :arrival, :ride,:price);");
            $statement->execute(array(
                "distance" => 0,
                "departure_time" => 0,
                "eco_result" => 0,
                "duration" => 0,
                "description" => "",
                "departure" => $dep_id,
                "arrival" => $arr_id,
                "ride" => $id,
                "price" => 0,

            ));

        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème d'insertion dans la table Car");
        }

    }

    public function getCarsFromUserId($user_id){
        try{
            $statement = $this->connexion->prepare("SELECT * FROM Car WHERE owner = :id;");
            $statement->execute(array(
                "id" => $user_id
            ));
            $result=$statement->fetchAll();
            return($result);
        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème avec la table Car");
        }
    }

    public function getCars(){
        try{
            $statement = $this->connexion->prepare("SELECT * FROM Car;");
            $statement->execute();
            $result=$statement->fetchAll();
            return($result);
        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème avec la table Car");
        }
    }

    public function UpdateCar($content){
        try{
            $statement = $this->connexion->prepare("UPDATE Car SET `model`=:model, `color`=:color, `nb_seats`=:nb_seats, `owner`=:owner WHERE `idCar`=:idCar;");
            $statement->execute(array(
                "model" => $content["model"],
                "color" => $content["color"],
                "nb_seats" => $content["nb_seats"],
                "owner" => $content["owner"],
                "idCar" => $content["idCar"],
            ));
            //$result=$statement->fetch(\PDO::FETCH_ASSOC);
            //return($result);
        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème d'update dans la table Car");
        }
    }

    public function DeleteCar($id){
        try{
            $statement = $this->connexion->prepare("DELETE FROM Car WHERE `idCar`=:idCar;");
            $statement->execute(array(
                "idCar" => $id,
            ));
        }
        catch(PDOException $e){
            $this->deconnexion();
            throw new Exception("problème de delete dans la table Car");
        }

    }
}
