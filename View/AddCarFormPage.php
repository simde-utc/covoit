<?php

require_once("Page.php");

class AddCarFormPage extends Page
{
    public function __construct($title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
    }

    public function generateContent(){
        $colors=['white', 'black', 'red', 'blue', 'purple', 'gray', 'red', 'green'];
        $this->content = <<<HTML
        <form action="" method="POST">
          <div class="form-group">
            <label for="model">Modèle</label>
            <input class="form-control" name="model" placeholder="Renault Twingo">
          </div>
          <div class="form-group">
            <label for="color">Couleur</label>
            <select class="form-control" name="color">
HTML
;
        foreach($colors as $color){
            $this->content .= "<option style='color:{$color};'>{$color}</option>";
        }

        $this->content .= <<<HTML
            </select>
          </div>
          <div class="form-group">
            <label for="nb_seats">Nombre de sièges</label>
            <input class="form-control" name="nb_seats" min="1" max="5">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
HTML
;
    }

}
