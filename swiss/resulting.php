<pre>
	<?php
	require "../db.php";
	#require "../libs/playersplaces.php";
	#require "../libs/players_status.php";
	$curtour = R::findone('tournaments','status = 1');
	$curtour -> round +=1;
	R::store($curtour);

	$players = R::findall('battle','status > 0');	
	foreach ($players as $player) {
		$player -> plaing = false;		
	}
	R::storeall($players);

	$all_games=R::findall('round');
	foreach ($all_games as $game) {
		$white = R::findone('battle','id = ?',[$game -> id_white]);
		$black = R::findone('battle','id = ?',[$game -> id_black]);
		switch ($game -> result) {
			case 0: #white won
				$white -> points +=1;
				$white -> zb +=($white -> zb) + ($black -> points);
				break;
			case 1: #draw
				$white -> zb +=($white -> zb) + 0.5*($black -> points);
				$black -> zb +=($black -> zb) + 0.5*($white -> points);
				$white -> points +=0.5;				
				$black -> points +=0.5;				
				break;
			case 2: #black won
				$black -> points +=1;
				$black -> zb +=($black -> zb) + ($white -> points);
				break;			
		}	
		R::store($white);
		R::store($black);
		$game -> id_white = 0;
		$game -> id_black = 0;
		$game -> result = null;
		R::store($game);	
	}	
	$allplayers=R::findall( 'battle','ORDER BY `points` DESC, `cb` DESC, `zb` DESC' );
	$p=1;
	foreach ($allplayers as $player) {
		$player -> place = $p;
		$p++;	
	}
	R::storeall($allplayers);
	header("list.php")
	 ?>
</pre>