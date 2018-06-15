<?php

function get_handler($controller, $data) {
  $base = './controllers/' . $controller . '.php';
  $static = './controllers/tpl/page.php';
  $theme_base = THEME_FOLDER . '/handlers/' . $controller . '.php';
  error_log('LOGGING BASE || '. $controller);
  if(file_exists($theme_base)) {
    require $theme_base;
  } else if(file_exists($base)) {
    require $base;
  } else {
    require $static;
  }
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $theme_routes = THEME_FOLDER . '/_cfg/' . 'routes.php';

    //Default Home Route
    $r->addRoute('GET', '/', 'home');

    // SEO Routes
    $r->addRoute('GET', '/robots.txt', 'seo/robots');
    $r->addRoute('GET', '/sitemap.xml', 'seo/sitemap');
    $r->addRoute('GET', '/sitemaps/{map}.xml', 'seo/sitemap');

    //Asset Routes
    $r->addRoute('GET', '/styles/compiled.css', 'assets/scss');

    //API / Form routes
    $r->addRoute('POST', '/api/form', 'api/form');
    $r->addRoute('GET', '/api/form', 'api/form');

    if(file_exists($theme_routes)) {
      require $theme_routes;
    }
    //$r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        get_handler('tpl/404', array('tpl' => $tpl, 'api' => $polymath, 'url' => $routeInfo));
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        get_handler('tpl/405', array('tpl' => $tpl, 'api' => $polymath, 'url' => $routeInfo));
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $tpl_engine->addGlobal('uri', $uri);
        $tpl_engine->addGlobal('handler', $handler);
        get_handler($handler, array('tpl' => $tpl, 'api' => $polymath, 'url' => $routeInfo));
        break;
}
?>
