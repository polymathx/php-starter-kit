<?php
  // Genertic controller for static pages -- just add an html file.
  require './controllers/tpl.php';
  if($route_vars['page'] && file_exists($tpl->get_file_path($route_vars['page'] . '.html'))) {
    echo $tpl->get($route_vars['page'] . '.html', $params);
  } else {
    get_handler('tpl/404', $data);
  }
?>
