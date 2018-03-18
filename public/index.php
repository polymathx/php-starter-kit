<?php
//Config
require 'config/config.php';

// Include the main class, the rest will be automatically loaded
require 'vendor/autoload.php';

// Include additional dependencies
require 'class/PolymathApiLoader.php';

// Template controller
$tpl = new Dwoo\Core();

// Polymath API Loader
$polymath = new PolymathApiLoader;
$polymath->set_key($config['api_key']);
$website_meta = array('global_meta' => $polymath->build_meta_data());

//Load Routes
require 'config/routes.php';

?>
