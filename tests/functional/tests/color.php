<h2>Color functions</h2>
<?php
$result = 'results/darken.jpg';
$result2 = 'results/brighten.jpg';
$result3 = 'results/greyscale.jpg';
$result4 = 'results/invertcolors.jpg';

$p = &new phmagick($kiwi100,  $result);
$p->debug()
  ->darken()
;

$p = &new phmagick($kiwi100,  $result2);
$p->debug()
  ->brighten(30)        
;

$p = &new phmagick($kiwi100,  $result3);
$p->debug()
  ->toGreyScale()
;

$p = &new phmagick($kiwi100,  $result4);
$p->debug()
  ->invertColors()
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
                <td>
			<img src="<?php echo $result4;?>">
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
			Greyscale:
		</td>
                
                <td>
			Invert colors:
		</td>

	</tr>
</table>

