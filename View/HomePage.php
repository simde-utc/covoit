<?php

require_once("Page.php");

class HomePage extends Page
{
  public function __construct($title="", $author="", $desc=""){
      parent::__construct($title, $author, $desc);
      }

      public function generateContent(){
          $this->content = <<<HTML
          <form>
            <input type="button" value="Ajouter un trajet" onclick="window.location.href='/rides/add/'" />
            <input type="button" value="Rechercher un trajet" onclick="window.location.href=''" />
            <br><br><br><br>
            Trajets:<br>
            <input type="button" value="Mes trajets publiés" onclick="window.location.href='/rides/'" />
            <input type="button" value="Mes réservations" onclick="window.location.href='/rides/'" />
            <br><br><br><br>
            Voitures:<br>
            <input type="button" value="Ajouter une voiture" onclick="window.location.href='/cars/add/'" />
            <input type="button" value="Supprimer une voiture" onclick="window.location.href='/cars/'" />
          </form>
HTML
;
      }

}
