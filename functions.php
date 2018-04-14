<?php

function __autoload($className){
    $address = array('App/', 'Controller/', 'Model/', 'Ressources/', 'View/');
    foreach($address as $a){
        if(file_exists($a.$className.'.php')) {
            require_once($a.$className.'.php');
            return true;
        }    
    }
    return false;
}