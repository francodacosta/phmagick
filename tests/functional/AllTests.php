<h1>phMagick functional Tests</h1>
<style>

	table.results {
		border: 1px solid #000;
	}

	table.results td {
		padding: 0 20px 0 20px;
	}
</style>
<?php
require_once '../../phmagick.php';

$kiwi = './data/500px-Kiwi_aka.jpg';

/* Cleanup old tests */
$files = glob('results/*.*');

echo "<p> clearing results folder ";
foreach($files as $f)
{
    unlink ($f );
    echo '.';
}
echo "</p>";
?>

<h1>Original Image</h1>
<img src="<?php echo $kiwi;?>">

<?php

include 'tests/resize.php';
include 'tests/tile.php';
include 'tests/border.php';
include 'tests/optimizations.php';
include 'tests/color.php';
?>
<p>
Kiwi image By Andr&eacute; Karwath aka Aka (Own work) [CC-BY-SA-2.5 (www.creativecommons.org/licenses/by-sa/2.5)], via Wikimedia Commons
</p>