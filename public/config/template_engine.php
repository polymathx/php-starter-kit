<?php
  /*
   This file starts by loading the polymath template class, then kickstarts it using a
   templating engine of your choosing.

   By default, we choose to use dwoo -- but you could in theory inject a smarty template
   engine here, or whatever the crap you want!
   */

  // Load Template Helper class
  require 'class/PolymathTemplateHelper.php';
  $tpl = new PolymathTemplateHelper;
  $tpl_engine = new Dwoo\Core();

  // Init SCSS Loader
  require 'config/scss_loader.php';

  // Kickstart Dwoo & set global template vars.
  $tpl_engine->addGlobal('tpl', $tpl);
  $tpl_engine->addGlobal('csrf_token', $_SESSION['token']);
  $tpl_engine->addGlobal('global_scss', $global_scss);

  // Init Template class w/ engine & data
  $tpl->init($polymath, $tpl_engine);

?>
