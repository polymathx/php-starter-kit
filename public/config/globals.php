<?php
  define('CONFIG', $config);
  define('CSRF_TOKEN', $_SESSION['token']);
  define('THEME_FOLDER', $tpl->get_theme_folder());
  $website_meta = array('global_meta' => $polymath->build_meta_data());
  define('GLOBAL_META', $website_meta['global_meta']);
  define('ASSETS_FOLDER', $tpl->get_assets_folder());


?>
