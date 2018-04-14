<?php
function __autoload($className){
    $address = array('App/', 'Controller/', 'Model/', 'Ressources/', 'View/');
    foreach($address as $a){
        var_dump($className);
        if(file_exists($a.$className.'.php')) {
            require_once($a.$className.'.php');
            return true;
        }    
    }
    return false;
}

$p = new CarPage("mon_titre", "mon_auteur", "ma_description");
$p->appendHeader("Header");
$p->appendContent("Content");
$p->appendFooter("Footer");
$p->display();