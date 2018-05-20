<?php
  // Shared SCSS Compiling
  use Leafo\ScssPhp\Compiler;
  $scss = new Compiler();
  $scss->setImportPaths("templates/shared/assets/scss/");

  $global_scss = $scss->compile('@import "style.scss"');
?>
