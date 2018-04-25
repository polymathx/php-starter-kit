<?php

// Include global template handler.
require './controllers/tpl.php';
$params->assign('content', $api->get('/'));

echo $tpl->get('index.html', $params);

?>
