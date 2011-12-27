<?php
include '../../phMagick/phMagick.php';
include 'fTest/bootstrap.php';

use fTest\AutoLoad;

$autoLoader = new AutoLoad();
$autoLoader->setClassPath('tests' , __DIR__ . '/tests/');