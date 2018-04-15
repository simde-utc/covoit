<?php

require_once("Page.php");

class RidePage extends Page
{
    private $ride = null;
    public function __construct($RidePage, $title="", $author="", $desc=""){
        parent::__construct($title, $author, $desc);
        $this->ride = $RidePage;
    }
 
    public function generateContent(){
        $this->content = <<<HTML
        <p>Mon ride : description({$this->ride["description"]}), sièges disponibles({$this->ride["nb_free_seats"]}), bagages({$this->ride["value_luggage"]}), voiture({$this->ride["car"]}), conducteur({$this->ride["user_id"]}), date({$this->ride["date"]})</p>
HTML
;
    }   
    
}