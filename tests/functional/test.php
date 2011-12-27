<?php
include 'fTest/bootstrap.php';

use fTest\TestCase;

class foo extends TestCase
{
    public function test() {
        return 3 + 1;
    }
}

$f = new foo();
var_dump($f->getTestCode());