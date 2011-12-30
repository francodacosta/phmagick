<h1>phMagick self documenting tests</h1>
<style>

body {
font-size: 12px
}

h2 {
font-size: 14px;
margin-top:60px;
}

div.test {
margin-left:20px;
}

div.code{
white-space: pre;
margin-left:20px;
}

p.description{
text-style: italic;
}
</style>
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
use tests\Action\Resize\Porportional;
use tests\Action\Resize\Stretch;
use tests\Action\Watermark;


$runner = new TestRunner();

$runner->add(new Porportional());
$runner->add(new Stretch());
$runner->add(new Watermark());


$runner->run();

?>
<p>
Kiwi image By Andr&eacute; Karwath aka Aka (Own work) [CC-BY-SA-2.5 (www.creativecommons.org/licenses/by-sa/2.5)], via Wikimedia Commons
</p>