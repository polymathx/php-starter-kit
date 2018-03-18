<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    case '/':
        require 'controllers/home.php';
        break;

    //Items Below are unique to each site
    case '/robots.txt':
        require 'controllers/seo/robots.php';
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        require 'controllers/404.php';
        break;
}

?>