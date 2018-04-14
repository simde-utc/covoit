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

 // Constructeur de la classe
 // Initialise la connexion et renvoie une ConnexionException en cas d'echec de la connexion à la base de donnée

     public function __construct(){
       try{
         $chaine="mysql:host=localhost;dbname=mydb";
         $this->connexion = new PDO($chaine,"root","root");
         $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
      try{	//on cherche le total de parties gagnées par un joueur (représenté par son pseudo) et on le stock dans nbr_parties_g
        $statement = $this->connexion->prepare("SELECT * FROM ride WHERE idRide = :id;");
        $statement->execute(array(
          "id" => $id
        ));
        $result=$statement->fetch(PDO::FETCH_ASSOC);
      if ($result["nbr_parties_g"]==NUll){//si le joueur n'a pas encore fait de partie on balance une exception
        throw new PasDePartieException("Ce joueur n'a pas encore joué de parties")
      }
      else{//sinon on retourne nbr_parties_g (nbr de partie gagnées
        return $result["nbr_parties_g"];
      }
    }
    catch(PDOException $e){
      $this->deconnexion();
      throw new TableAccesException("problème avec la table partie");
    }

    }

}
