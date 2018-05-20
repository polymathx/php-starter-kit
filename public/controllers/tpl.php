<?php
  // Global Vars for TPL controllers
  // Parses Data Object
  $url = $data['url'];
  $tpl = $data['tpl'];
  $api = $data['api'];
  $route_vars = $url[2];

  //Dwoo Data
  // Create a data set, this data set can be reused to render multiple templates if it contains enough data to fill them all
  $params = new Dwoo\Data();
  // Fill it with some data
  $params->assign('meta', GLOBAL_META);
  $params->assign('bodyclass', '');

?>
