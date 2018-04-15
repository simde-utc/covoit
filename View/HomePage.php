<?php

require_once("Page.php");

use App\Route;

class HomePage extends Page
{
    public function __construct($title="", $author="", $desc=""){
          parent::__construct($title, $author, $desc);
          $this->appendCssUrl("Ressources/css/styleHomePage.css");
    }

    public function generateContent(){
        
        $link1 = Route::getUrl('/rides/add/');
        $link2 = Route::getUrl('/');
        $link3 = Route::getUrl('/');
        $link4 = Route::getUrl('/');
        $link5 = Route::getUrl('/cars/add');
        $link6 = Route::getUrl('/cars/');
        
		  $this->content = <<<HTML
            <div class="container">
                  <div class="row vertical-align">
                    <div onclick="window.location.href='{$link1}';" id="addRide" class="buttonHome col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <p>Ajouter un trajet</p>
                    </div>
                    <div onclick="window.location.href='{$link2}';"  id="findRide" class="buttonHome col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <p>Rechercher un trajet</p>
                    </div>
                    <div onclick="window.location.href='{$link3}';"  id="addRide" class="buttonHome col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <p>Mes trajets publiés</p>
                    </div>
                  </div>
                <div class="row vertical-align">
                    <div onclick="window.location.href='{$link4}';"  id="findRide" class="buttonHome col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <p>Mes réservations</p>
                    </div>
                    <div onclick="window.location.href='{$link5}';"  id="addRide" class="buttonHome col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <p>Ajouter une voiture</p>
                    </div>
                    <div onclick="window.location.href='{$link6}';"  id="findRide" class="buttonHome col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <p>Supprimer une voiture</p>
                    </div>
                </div>
            </div>
HTML
;
          
          
          /*$this->content = 
            "<input type='button' value='Ajouter un trajet' onclick='window.location.href='".Route::getUrl('/rides/add/')."'/>
            <input type='button' value='Rechercher un trajet' onclick='window.location.href='".Route::getUrl('/')."'/>
            
            <input type='button' value='Mes trajets publiés' onclick='window.location.href='".Route::getUrl('/')."'/>
            <input type='button' value='Mes réservations' onclick='window.location.href=\'".Route::getUrl('/')."'/>
            
            <input type='button' value='Ajouter une voiture' onclick='window.location.href=\'".Route::getUrl('/cars/add')."'/>
            <input type='button' value='Supprimer une voiture' onclick='window.location.href=\'".Route::getUrl('/cars/')."'/>";*/
      }

}
