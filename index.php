<?php
require_once("View/CarPage.php");
	
$p = new CarPage("mon_titre", "mon_auteur", "ma_description");
$p->appendHeader("Header");
$p->appendContent("Content");
$p->appendFooter("Footer");
$p->display();