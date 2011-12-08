<?php
require __DIR__ . '/' . 'Core/autoload.php';

use phMagick\Core\AutoLoad;

$autoLoader = new AutoLoad();
$autoLoader->setClassPath('phMagick' , __DIR__);