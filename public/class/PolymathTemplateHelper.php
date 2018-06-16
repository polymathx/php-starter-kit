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

		function url() {
			if(!empty($_SERVER['HTTP_CF_VISITOR'])){
				$cf_data = json_decode($_SERVER['HTTP_CF_VISITOR'],true);
				$proto .= $cf_data['scheme'] ? $cf_data['scheme'] .'://' : 'http://';
			} else{
				$proto .= !empty($_SERVER['HTTPS']) ? "https://" : "http://";
			}
			return $proto . $_SERVER['HTTP_HOST'] . '/';
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
