<?php

namespace App;

/**
 *
 */
class Request
{
	protected $path;
	protected $queries;
	protected $verb;
	protected $args;

    public function __construct() {
		$parsedUrl = parse_url(preg_replace("#/+#", '/', str_replace('\\', '/', $_SERVER['REQUEST_URI'])));

		$this->path = $this->getPathParts($parsedUrl['path']);
		$this->queries = array_merge(
			$parsedUrl['query'] ?? [],
			json_decode(file_get_contents('php://input'), true) ?? []
		);
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

		$args = [];
		foreach ($path as $key => $part) {
			if ($part !== $this->path[$key]) {
				if (preg_match("/^{(\w*)}$/", $part, $matches))
					$args[$matches[1]] = $this->path[$key];
				else
					return false;
			}
		}

		$this->args = $args;

		return true;
	}

	public function input($name, $default = null) {
		return $this->queries[$name] ?? $default;
	}

	public function arg($name, $default = null) {
		return $this->args[$name] ?? $default;
	}
}
