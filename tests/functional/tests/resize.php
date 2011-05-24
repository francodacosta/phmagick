<h2>Resize Test (mantaining aspect ratio)</h2>
<?php
$result = 'results/resize_100_100.jpg';
$result2 = 'results/resize_300_100.jpg';
$result3 = 'results/resize_200_0.jpg';
$result4 = 'results/resize_0_100.jpg';

$p = &new phmagick($kiwi,  $result);
$p->debug();
$p->resize(100,100);

$p->destination($result2)
  ->debug()
  ->resize(300, 100);

$p->destination($result3)
  ->debug()
  ->resize(200);

$p->destination($result4)
  ->debug()
  ->resize(0, 100);



 list($w1, $h1) = getimagesize($result);
 list($w2, $h2) = getimagesize($result2);
 list($w3, $h3) = getimagesize($result3);
 list($w4, $h4) = getimagesize($result4);
?>

<table class="results">
	<tr>
		<td>
			<img src="<?php echo $result;?>">
		</td>
		<td>
			<img src="<?php echo $result2;?>">
		</td>
		<td>
			<img src="<?php echo $result3;?>">
		</td>
		<td>
			<img src="<?php echo $result4;?>">
		</td>
	</tr>
	<tr>
		<td>
			resize: 100 x 100 <br>
			actual size: <?php echo $w1 . ' x ' . $h1;?>
		</td>

		<td>
			300 x 100<br>
			actual size: <?php echo $w2 . ' x ' . $h2;?>
		</td>

		<td>
			width 200px<br>
			actual size: <?php echo $w3 . ' x ' . $h3;?>
		</td>

		<td>
			height 100<br>
			actual size: <?php echo $w4 . ' x ' . $h4;?>
		</td>
	</tr>
</table>

