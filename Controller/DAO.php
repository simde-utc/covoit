<?php
namespace Controller;

use Model\Ride;

require_once "Model/Ride.php";
/**
 *
 */
class DAO
{
    /**
     *
     */
    private $user_id;
    private $connexion;


    public function __construct(){
        $this->user_id = 1;
        try{
            $chaine="mysql:host=localhost;dbname=mydb";
            $this->connexion = new \PDO($chaine,"root","root");
            $this->connexion->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            $exception=new Exception("Problème de connection à la base de donnée");
            throw $exception;
        }
    }

    public function deconnexion(){
        $this->connexion=null;
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

    public function addCar($content){
        try{
            $statement = $this->connexion->prepare("INSERT INTO Car VALUES (NULL,:model,:color,:nb_seats,:owner);");
            $statement->execute(array(
                "model" => $content["model"],
                "color" => $content["color"],
                "nb_seats" => $content["nb_seats"],
                "owner" => $content["owner"]
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
            $statement = $this->connexion->prepare("INSERT INTO Ride VALUES (null,:description,:nb_free_seats,:value_luggage,:car,:user_id, NOW());");
            $statement->execute(array(
                "description" => $inputs["description"],
                "nb_free_seats" => $inputs["nb_free_seats"],
                "value_luggage" => $inputs["value_luggage"],
                "car" => $inputs["car"],
                "user_id" => $this->user_id
            ));

            $dep_id = uniqid();
            $statement = $this->connexion->prepare("INSERT INTO Place VALUES (:id,:text_adress,:description,POINT(:x, :y));");
            $statement->execute(array(
                "id" => $dep_id,
                "text_adress" => $inputs["departure"],
                "description" => "",
                "x" => 0,
                "y" => 0
            ));

            $statement = $this->connexion->prepare("INSERT INTO Step VALUES (null,:distance, :departure_time, :eco_result,:duration,:description,:departure, :arrival, :ride, :price);");
            $statement->execute(array(
                "distance" => 0,
                "departure_time" =>$inputs["departure_time"],
                "eco_result" => 0,
                "duration" => 0,
                "description" => "",
                "departure" =>$dep_id,
                "arrival" => $dep_id,
                "ride" => 5,
                "price" => 0
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
}
