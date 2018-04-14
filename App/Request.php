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
		for ($i = 1; $i < count($this->getPathParts($_SERVER['PHP_SELF'])); $i++)
			array_shift($this->path);

		$this->queries = array_merge(
			$parsedUrl['query'] ?? [],
			json_decode(file_get_contents('php://input'), true) ?? []
		);
		$this->verb = strtoupper($_SERVER['REQUEST_METHOD']);
    }

	protected function getPathParts($path) {
		$path = explode('/', $path);

		if (isset($path[0]) && empty($path[0]))
			array_shift($path);
		if (end($path) !== null && empty(end($path)))
			unset($path[count($path) - 1]);

		return $path;
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
