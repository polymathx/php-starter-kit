<?php

	class PolymathApiLoader {
		var $key;
		var $cache;

		function init($conf, $cache) {
		    $this->key = $conf['api_key'];
				$this->cache = $cache;
		}

		function url($path) {
			return "https://api.polymathx.com$path?key=$this->key";
		}

		function build_meta_data() {
			$meta = $this->get('/meta');
			return $meta[0];
		}

		function get($path = '/') {
			$url = $this->url($path);
			$cache_tag = hash('sha256', $url);

			if($data = $this->cache->get_cache($cache_tag)){
				$data = json_decode($data, true);
			} else {
				$data = $this->cache->do_curl($url);
				$this->cache->set_cache($cache_tag, $data);
				$data = json_decode($data, true);
			}

			return $data;
		}

		function test($data) {
			return $this->url();
		}

	}
?>
