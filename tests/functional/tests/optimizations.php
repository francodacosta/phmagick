<h2>image optimization behaviours</h2>
<?php
$result = 'results/optmz_1.jpg';
$result2 = 'results/optmz_2.jpg';
$result3 = 'results/optmz_3.jpg';

$p = &new phmagick($kiwi100,  $result);
$p->debug()
  ->quality(10)
;

$p = &new phmagick($kiwi100,  $result);
$p->destination($result2)
  ->debug()
  ->quality(90)
;

$p = &new phmagick($kiwi100,  $result);
$p->destination($result3)
  ->debug()
  ->quality(90)
;
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

