<?php

// TODO - Make this work. 

header("Content-Type: text/css");

use Leafo\ScssPhp\Compiler;

$scss = new Compiler();

echo $scss->compile('
  $color: #abc;
  div { color: lighten($color, 20%); }
');

//$stat = stat(ASSETS_FOLDER);

?>
