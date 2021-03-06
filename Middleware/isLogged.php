<?php

namespace Middleware;

use App\Route;

class isLogged {
	public function handle($request, $next) {
		if (!empty($_SESSION))
			return $next($request);

		Route::redirect('/login');
		return false;
	}
}
