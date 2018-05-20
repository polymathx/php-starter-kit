<?php
// Include the main class, the rest will be automatically loaded
require 'vendor/autoload.php';

//Config
require 'config/config.php';

// Include additional dependencies
require 'class/PolymathApiLoader.php';

// Polymath API Loader
$polymath = new PolymathApiLoader;
$polymath->init($config, $cache);

//Template Engine Init
require 'config/template_engine.php';

//Global Vars Setter
require 'config/globals.php';

//Load Routes
require 'config/routes.php';

?>
