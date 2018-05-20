<?php

	class PolymathTemplateHelper {
		var $tpl;
    var $conf;

		function init($polymath_api, $tpl_engine) {
		    $this->tpl = $tpl_engine;
        $this->conf = $polymath_api->conf;
        openlog("polymathTplLogger", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		}

    function get_theme_folder() {
      return './templates/' . $this->conf['theme'];
    }

		function get_assets_folder() {
			return $this->get_theme_folder() . '/assets/';
		}

		function assets_url($file) {
			return ltrim($this->get_assets_folder() . $file, '.');
		}

		function form_submit() {
			return "/api/form";
		}

    function theme_path($path) {
      return $this->get_theme_folder() . '/' . $path;
    }

    function shared_path($path) {
      return './templates/shared/' . $path;
    }

		function url_parts() {
			$pageURL = 'http';
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			return parse_url($pageURL);
		}

    function get_file_path($path) {
      $in_shared = $this->shared_path($path);
      $in_theme = $this->theme_path($path);
      return file_exists($in_theme) ? $in_theme : $in_shared;
    }

    function get($path, $data = array()) {
      $clean_path = $this->get_file_path($path);
      syslog(LOG_INFO, "Loading Primary Template: $clean_path");
      return $this->tpl->get($clean_path, $data);
    }

	}
?>
