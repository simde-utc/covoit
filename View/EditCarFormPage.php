<?php

require_once("Page.php");

class EditCarFormPage extends Page
{
    private $car = null;
    public function __construct($CarObject, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->car = $CarObject;
    }
 
    public function generateContent(){
        $colors=['white', 'black', 'red', 'blue', 'purple', 'gray', 'red', 'green'];
        $this->content = <<<HTML
        <form action="submitCar" method="POST">
          <div class="form-group">
            <label for="model">Modèle</label>
            <input class="form-control" name="model" value="{$this->car["model"]}">
          </div>
          <div class="form-group">
            <label for="color">Couleur</label>
            <select class="form-control" name="color" value="{$this->car["color"]}">
                "<option style='color:{$this->car["color"]};'>{$this->car["color"]}</option>
HTML
;
        foreach($colors as $color){
            if($color != $this->car["color"]){
                $this->content .= "<option style='color:{$color};'>{$color}</option>";                
            }
        }
        
        $this->content .= <<<HTML
            </select>
          </div>
          <div class="form-group">
            <label for="nb_seats">Nombre de sièges</label>
            <input class="form-control" name="nb_seats" min="1" max="5" value="{$this->car["nb_seats"]}">
          </div>
          <input type="hidden" name="idCar" value="{$this->car["idCar"]}" />
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
HTML
;
    }   
    
}
