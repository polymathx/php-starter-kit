<?php

function throwConfigError() {
	echo "<h1>ERROR: No config file found. Please run install file.";
}

// Load Init Configs
$ini_file = "./polymath.ini";

if(file_exists($ini_file)) {
	// Set config
	$config = parse_ini_file($ini_file);
	// Build Cache
	$cache = new Gilbitron\Util\SimpleCache();
	$cache->cache_path = $config['cache']['path'];
	$cache->cache_time = intval($config['cache']['time']);
} else {
	throwConfigError();
	return;
}

// Start Session & Generate CSRF tokens
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}



?>
