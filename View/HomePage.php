<?php

require_once("Page.php");

use App\Route;

class HomePage extends Page
{
  public function __construct($title="", $author="", $desc=""){
      parent::__construct($title, $author, $desc);
      }

      public function generateContent(){
		  $this->content = '
          <form>
            <input type="button" value="Ajouter un trajet" onclick="window.location.href=\''.Route::getUrl('/rides/add/').'\'" />
            <input type="button" value="Rechercher un trajet" onclick="window.location.href=\''.Route::getUrl('/').'\'" />
            <br><br><br><br>
            Trajets:<br>
            <input type="button" value="Mes trajets publiés" onclick="window.location.href=\''.Route::getUrl('/').'\'" />
            <input type="button" value="Mes réservations" onclick="window.location.href=\''.Route::getUrl('/').'\'" />
            <br><br><br><br>
            Voitures:<br>
            <input type="button" value="Ajouter une voiture" onclick="window.location.href=\''.Route::getUrl('/cars/add').'\'" />
            <input type="button" value="Supprimer une voiture" onclick="window.location.href=\''.Route::getUrl('/cars/').'\'" />
		  </form>';
      }

}
