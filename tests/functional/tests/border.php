<h2>Border Test</h2>
<?php
$test = 'results/border_sample.jpg';
$result1 = 'results/border_1.jpg';
$result2 = 'results/border_2.jpg';
$result3 = 'results/border_3.jpg';


$p = &new phmagick($kiwi100,  $test);
$p->debug();
$p->destination($result1)
  ->debug()
  ->border();

$p->destination($result2)
  ->debug()
  ->border('#00f', 3);

$p->destination($result3)
  ->debug()
  ->border('#0f0');



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
			default border
		</td>

		<td>
			blue border, size 3
		</td>

		<td>
			green border
		</td>
	</tr>
</table>

