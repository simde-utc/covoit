<?php

namespace Services;

class GoogleMaps {
	protected $url;
	protected $key;

	public function __construct() {
		$config = config('google');

		$this->url = $config['url'];
		$this->key = $config['key'];
	}

	protected function call($url, $queries = []) {
		return json_decode(file_get_contents($this->url.$url.'?'.http_build_query(array_merge(
			[ 'key' => $this->key ],
			$queries
		))), true);
	}

	public function ride($origins, $destinations) {
		return $this->call('distancematrix/json', [
			'origins' => $origins,
			'destinations' => $destinations,
		]);
	}

	public function searchByText($text) {
		return $this->call('place/textsearch/json', [
			'query' => $text
		]);
	}
}
