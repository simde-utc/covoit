<?php

namespace Middleware;

use App\Route;

class isNotLogged {
	public function handle($request, $next) {
		if (empty($_SESSION))
			return $next($request);

		Route::redirect('/');
		return false;
	}
}
