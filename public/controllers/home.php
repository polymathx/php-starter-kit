<?php
	//Load the data
	$data = $polymath->get();

	// Output the result
	echo $tpl->get('index.html', $data);
?>
