<?php
// Include the main class, the rest will be automatically loaded
require 'vendor/autoload.php';

//Config
require 'config/config.php';

// Include additional dependencies
require 'class/PolymathApiLoader.php';
require 'class/PolymathTemplateHelper.php';

// Polymath API Loader
$polymath = new PolymathApiLoader;
$polymath->init($config, $cache);

// Template controller
$tpl_engine = new Dwoo\Core();
$tpl = new PolymathTemplateHelper;
$tpl->init($polymath, $tpl_engine);

define('THEME_FOLDER', $tpl->get_theme_folder());

$website_meta = array('global_meta' => $polymath->build_meta_data());
define('GLOBAL_META', $website_meta['global_meta']);

//Load Routes
require 'config/routes.php';

?>
