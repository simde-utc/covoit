<?php

require_once("Page.php");

class CarPage extends Page
{
    private $car = null;
    public function __construct($CarObject, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->car = $CarObject;
    }

    public function generateContent(){
        $this->content = <<<HTML
        <p>Ma voiture : modèle({$this->car["model"]}), couleur({$this->car["color"]}), sièges({$this->car["nb_seats"]}) et {$this->car["user_id"]}.</p>
HTML
;
    }

}
