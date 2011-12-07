<h2>Tile test</h2>
<?php
$tst_image  = 'results/tile_img_1.jpg';
$result1 = 'results/tile_result_1.jpg';
$result2 = 'results/tile_result_2.jpg';
$result3 = 'results/tile_result_3.jpg';

$p = &new phmagick($kiwi100,  $tst_image);
$p->debug();
$p->resize(100,100);

$p->destination($result1)->debug()
  ->tile(array($tst_image,$tst_image,$tst_image));

$p->destination($result2)->debug()
  ->tile(array($tst_image,$tst_image,$tst_image, $tst_image), 2, 2);

$p->destination($result3)->debug()
  ->tile(array($tst_image,$tst_image,$tst_image), 1, 3);

?>

<table class="results">
	<tr>
		<td>
			<img src="<?php echo $result1;?>">
		</td>
		<td>
			<img src="<?php echo $result2;?>">
		</td>
		<td>
			<img src="<?php echo $result3;?>">
		</td>
	</tr>
	<tr>
		<td>
			tile horizontal
		</td>

		<td>
			tile 2 x 2
		</td>

		<td>
			tile vertical
		</td>
	</tr>
</table>

