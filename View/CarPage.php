<?php

//class CarPage extends Page
class CarPage
{
    //public function __construct($title="", $author="", $desc=""){
    public function __construct($CarObject){

        //parent::__construct("","","");

        echo $CarObject["model"];
        echo $CarObject["color"];

    }
    
    //rédéfinir les generate()
}
