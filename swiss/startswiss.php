<?php 
 require "../db.php";
$players = R::findall('battle','ORDER BY `id`');
$i=1;
foreach ($players as $player) {
	$player -> points = 0;
	$player -> cb = 0;
	$player -> zb = 0;
	$player -> place = $i;
	$i++;
	$player -> bye = false;
	$player -> ob_color = null;	
	$player -> plaing = false;	
	$player -> teams_id = $player -> users -> teams_id;
}
R::storeall($players);

	$curtour = R::findone('tournaments','status = 1'); //getting current tournament data
	if (!isset($curtour)){
		$cur = R::getall('SELECT * FROM `tournaments` WHERE `status` != 0    ORDER BY `date` LIMIT 1')[0];
		$curtour = R::findone('tournaments','id = ?',[$cur[id]]);
	}
	$curtour -> status = 1;
	$curtour -> round = 0;
	R::store($curtour);




header('location: /profile.php');
?>