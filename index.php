<?php
require_once("View/CarPage.php");
	new \Controller\RideController()->displayAddRide()
	echo $_SERVER['REQUEST_URI'];

	
$p = new CarPage("mon_titre", "mon_auteur", "ma_description");
$p->appendHeader("Header");
$p->appendContent("Content");
$p->appendFooter("Footer");
$p->display();