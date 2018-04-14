<?php
	require_once "App/Kernel.php";

	$p = new CarPage("mon_titre", "mon_auteur", "ma_description");
	$p->display();
