<h1>phMagick self documenting tests</h1>
<?php
/* Cleanup old tests */
$files = glob('results/*.*');

echo "<p> clearing results folder ";
foreach($files as $f)
{
    unlink ($f );
    echo '.';
}
echo "</p>";

require 'bootstrap.php';

use fTest\TestRunner;
use tests\Core\Resize\Porportional;
use tests\Core\Resize\Stretch;



$runner = new TestRunner();

$runner->add(new Porportional());
$runner->add(new Stretch());

$runner->run();

