<?php

	class PolymathApiLoader {
		var $key;
		var $cache;
		var $conf;

		function init($conf, $cache) {
		    $this->key = $conf['api_key'];
				$this->cache = $cache;
				$this->conf = $conf;
				openlog("polymathApiLogger", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		}

		function url($path) {
			return "https://api.polymathx.com$path?key=$this->key";
		}

		function build_meta_data() {
			$meta = $this->get('/meta');
			return $meta[0];
		}

		function contents_from_model($model_id) {
			return $this->get('/contents/model/'.$model_id);
		}

		function get_page($page) {
			return $this->get('/contents/'.$page);
		}

		function get($path = '/') {
			$url = $this->url($path);
			$cache_tag = hash('sha256', $url);

			if($data = $this->cache->get_cache($cache_tag)){
				syslog(LOG_INFO, "CACHED DATA FOUND: $cache_tag");
				$data = json_decode($data, true);
			} else {
				syslog(LOG_INFO, "NEEDS FRESH CACHE: $cache_tag");
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
