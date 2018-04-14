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

	public static function __callStatic($verb, $args) {
		if (count($args) < 2)
			return;

		if (self::getRequest()->isRouteCorresponding($verb, $args[0])) {
			if (isset($args[2])) {
				$class = '\\Middleware\\'.$args[2];

				require_once 'Middleware/'.$args[2].'.php';

				$return = (new $class)->handle(self::$request, function ($request) {
					return true;
				});

				if ($return !== true)
					exit;
			}

			$load = explode('@', $args[1]);
			$class = '\\Controller\\'.$load[0];
			$method = $load[1];

			require_once 'Controller/'.$load[0].'.php';

			(new $class)->$method(self::$request);

			exit;
		}
	}

	public static function redirect($redirect) {
		$relative = self::getRequest()->getPathParts($_SERVER['PHP_SELF']);
		array_pop($relative);

		header('Location: /'.implode('/', array_merge(
			$relative,
			self::getRequest()->getPathParts($redirect)
		)));
	}
}
