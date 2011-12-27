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
require_once '../../phMagick/phMagick.php';


class TestData
{
    public static $kiwi    =  'data/500px-Kiwi_aka.jpg';
    public static $kiwi100 =  'results/resize_100_100.jpg';
}

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
<img src="<?php echo TestData::$kiwi;?>">

<?php include 'tests/Core/Resize/Porportional.php'; ?>
<img src="<?php echo TestData::$kiwi100;?>">

<?php include 'tests/Core/Resize/Stretch.php' ;?>
<img src="results/stretch_50_200.png">

<p>
Kiwi image By Andr&eacute; Karwath aka Aka (Own work) [CC-BY-SA-2.5 (www.creativecommons.org/licenses/by-sa/2.5)], via Wikimedia Commons
</p>