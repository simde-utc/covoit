<?php

namespace Controller;

/**
 *
 */
class DAO
{
    /**
     *
     */

    private $connexion;

    // Constructeur de la classe vndflngfdlkn
    // Initialise la connexion et renvoie une ConnexionException en cas d'echec de la connexion à la base de donnée

    public function __construct(){
        try{
            $chaine="mysql:host=localhost;dbname=mydb";
            $this->connexion = new \PDO($chaine,"root","12test34");
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
            $result=$statement->fetch(\PDO::FETCH_ASSOC);
            print_r($result);
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

}
