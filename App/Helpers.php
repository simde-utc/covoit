<?php

function config($name) {
	$path = 'App/config';
	$names = explode('.', $name);

	foreach ($names as $key => $config) {
		if (file_exists($path.'/'.$config))
			$path .= '/'.$config;
		elseif (file_exists($path.'/'.$config.'.php'))
			$path .= '/'.$config.'.php';
		elseif (is_file($path)) {
			$data = include $path;

			for ($i = $key; $i < count($names); $i++) {
				if (isset($data[$names[$i]]))
					$data = $data[$names[$i]];
				else
					return null;
			}

			return $data;
		}
		else
			return null;
	}

	if (is_file($path))
		return include $path;
	else
		return null;
}

function env($name, $default = null) {
	return $GLOBALS[$name] ?? $default;
}
