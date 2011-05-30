<h2>Color functions</h2>
<?php
$result = 'results/darken.jpg';
$result2 = 'results/brighten.jpg';
$result3 = 'results/optmz_3.jpg';

$p = &new phmagick($kiwi,  $result);
$p->resize(100,100)
  ->debug()
;

$p = &new phmagick($kiwi,  $result2);
$p->debug()
  ->resize(100, 100)
  ->brighten(30)        
;

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
			darken 30%:
		</td>

		<td>
			brighten 30%:
		</td>

		<td>
			quality 90 stripped metadata:
		</td>

	</tr>
</table>

