<?php

namespace App;

use App\Request;

/**
 *
 */
class Route
{
	protected static $request;

	protected static function getRequest() {
		if (static::$request === null)
			static::$request = new Request;

		return static::$request;
	}

	public function __callStatic($method, $args){
		if (count($args) !== 2 && count($args) !== 3)
			return;

		if (self::getRequest()->isRouteCorresponding($method, $args[0])) {
			$load = explode('@', $args[1]);
			$class = '\\Controller\\'.$load[0];
			$method = $load[1];

			(new $class)->$method(self::$request);

			exit;
		}
	}
}
