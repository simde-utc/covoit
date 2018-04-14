<?php

namespace App;

/**
 *
 */
class Request
{
	protected $verb;
	protected $args;

    public function __construct() {
		$parsedUrl = parse_url(preg_replace("#/+#", '/', str_replace('\\', '/', $_SERVER['REQUEST_URI'])));

		$this->path = $this->getPathParts($parsedUrl['path']);
		$this->queries = $parsedUrl['query'];
		$this->verb = strtoupper($_SERVER['REQUEST_METHOD']);
    }

	protected function getPathParts($path) {
		return array_filter(explode('/', $path), function ($part) {
			return !empty($part);
		});
	}

	public function isRouteCorresponding($verb, $path) {
		if (strtoupper($verb) !== $this->verb)
			return false;

		$path = $this->getPathParts($path);

		if (count($path) !== count($this->path))
			return false;

		foreach ($path as $key => $part) {
			if ($part !== $this->path[$key] && strpos($path[$key], '{') === FALSE)
				return false;
		}

		return true;
	}
}
