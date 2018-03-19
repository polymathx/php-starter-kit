<?php
// Include the main class, the rest will be automatically loaded
require 'vendor/autoload.php';

//Config
require 'config/config.php';

// Include additional dependencies
require 'class/PolymathApiLoader.php';

// Template controller
$tpl = new Dwoo\Core();

// Polymath API Loader
$polymath = new PolymathApiLoader;
$polymath->init($config, $cache);
$website_meta = array('global_meta' => $polymath->build_meta_data());

//Load Routes
require 'config/routes.php';

?>
