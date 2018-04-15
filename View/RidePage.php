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
        var_dump($this->ride);
        $this->content = <<<HTML
        <p>Mon ride : </p>
HTML
;
    }   
    
}