<?php
	// Global TPL controller
	require './controllers/tpl.php';

	// Output the result
	header('HTTP/1.0 404 Not Found');
	echo $tpl->get('404.html');
?>
