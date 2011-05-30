<h2>image optimization behaviours</h2>
<?php
$result = 'results/optmz_1.jpg';
$result2 = 'results/optmz_2.jpg';
$result3 = 'results/optmz_3.jpg';

$p = &new phmagick($kiwi,  $result);
$p->quality(30);
$p->resize(100,100);

$p->destination($result2)
  ->debug()
  ->resize(300, 100);

$p->destination($result3)
  ->debug()
  ->resize(200);

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
	</tr>
	<tr>
		<td>
			quality 30:
		</td>

		<td>
			quality 90:
		</td>

		<td>
			quality 90 stripped metadata:
		</td>

	</tr>
</table>

