<?php

function throwConfigError() {
	echo "<h1>ERROR: No config file found. Please run install file.";
}

$ini_file = "./polymath.ini";

if(file_exists($ini_file)) {
	$config = parse_ini_file($ini_file);
} else {
	throwConfigError();
	return;
}

?>
