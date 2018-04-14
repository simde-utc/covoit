<?php

namespace Controller;

/**
 *
 */
class LoginController
{
    /**
     *
     */
    public function __construct()
    {
    }

	public function index($request) {
		echo 'J\'ai trouvé le LoginController !! du type '.$request->arg('type');
	}
}
