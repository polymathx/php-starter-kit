<?php
	class PolymathApiLoader {
		var $key;

		function set_key($key) {
		    $this->key = $key;
		}

		function url($path) {
			return "https://api.polymathx.com$path?key=$this->key";
		}

		function build_meta_data() {
			$meta = $this->get('/meta');
			return $meta[0];
		}

		function get($path = '/') {
			$json = file_get_contents($this->url($path));
			return json_decode($json, true);
		}

		function test($data) {
			return $this->url();
		}

	}
?>