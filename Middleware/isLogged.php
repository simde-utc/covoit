<?php

namespace Middleware;

use App\Route;

class isLogged {
	public function handle($request, $next) {
		if (isset($_SESSION['id']))
			return $next($request);

		Route::redirect('/login');
		return false;
	}
}
