<pre>
<?php 
require "../db.php";
	

$allplayers=R::findall( 'battle','ORDER BY `points` DESC, `cb` DESC, `zb` DESC' );
$p=1;
foreach ($allplayers as $player) {
	$player -> place = $p;
	$p++;	
}
R::storeall($allplayers);

 ?>
</pre>