<?php
require __DIR__ . '/' . 'AutoLoad.php';

use fTest\AutoLoad;

$autoLoader = new AutoLoad();
$autoLoader->setClassPath('fTest' , __DIR__);