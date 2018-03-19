<?php

	class PolymathTemplateHelper {
		var $tpl;
    var $conf;

		function init($polymath_api, $tpl_engine) {
		    $this->tpl = $tpl_engine;
        $this->conf = $polymath_api->conf;
        openlog("polymathTplLogger", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		}

    function theme_path($path) {
      return './templates/' . $this->conf['theme'] . '/' . $path;
    }

    function shared_path($path) {
      return './templates/shared/' . $path;
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
