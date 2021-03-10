<pre>
<?php 

require "../db.php";
$m=R::count('battle','status > 0');
#echo $n%2;
if ($m%2 == 1){
	$bye = R::findone('battle', '`bye`= false AND `status`>0 ORDER BY `place` DESC LIMIT 1');
	#print_r($bye);
	$bye -> bye = true;
	$bye -> points +=1;
	$bye -> plaing = true;
	R::store($bye);
	$m--;
}
$n=$m/2;
for ($i=1; $i<=$n; $i++){
	$b = R::findOrCreate('round', [board => $i]);
	$b -> id_white = 0;
	$b -> id_black = 0;
	$b -> result = null;
	R::store($b);
}
#include_once "../libs/playersplaces.php";
/*$allplayers=R::findall( 'battle','ORDER BY `points` DESC, `cb` DESC, `zb` DESC' );
$p=1;
foreach ($allplayers as $player) {
	$player -> place = $p;
	$p++;	
}
R::storeall($allplayers);*/

#var_dump($n);
#echo ($n/2);
$round = R::getCell('SELECT `round` FROM `tournaments` WHERE `status`=1');

function match($color1,$id1,$id2,$board){
	$p1 = R::load('battle',$id1);
	$p2 = R::load('battle',$id2);
	if ( ($id1 == $id2) or ( $p1 -> teams_id == $p2 -> teams_id ) or ($p1 -> plaing == true) or ($p2 -> plaing == true) ) {
		return false;
	} else {
		$game = R::findone('round','`board` = ?', [$board]);
		if ($color1 == 'white') {
			$game -> id_white = $id1;
			$game -> id_black = $id2;						
		} else {
			$game -> id_white = $id2;
			$game -> id_black = $id1;			
		}

		switch ($round) {
			case 0:
				$p1 -> r0op = $p2 -> id;
				$p2 -> r0op = $p1 -> id;
				$p1 -> r0res = null;
				$p2 -> r0res = null;
				if ($color1 == 'white') {
					$p1 -> r0color = 'white';
					$p2 -> r0color = 'black';								
				} else {
					$p2 -> r0color = 'white';
					$p1 -> r0color = 'black';					
				}
				break;
			case 10:
				$p1 -> r1op = $p2 -> id;
				$p2 -> r1op = $p1 -> id;
				$p1 -> r1res = null;
				$p2 -> r1res = null;
				if ($color1 == 'white') {
					$p1 -> r1color = 'white';
					$p2 -> r1color = 'black';								
				} else {
					$p2 -> r1color = 'white';
					$p1 -> r1color = 'black';					
				}
				break;
			case 2:
				$p1 -> r2op = $p2 -> id;
				$p2 -> r2op = $p1 -> id;
				$p1 -> r2res = null;
				$p2 -> r2res = null;
				if ($color1 == 'white') {
					$p1 -> r2color = 'white';
					$p2 -> r2color = 'black';								
				} else {
					$p2 -> r2color = 'white';
					$p1 -> r2color = 'black';					
				}
				break;
			case 3:
				$p1 -> r3op = $p2 -> id;
				$p2 -> r3op = $p1 -> id;
				$p1 -> r3res = null;
				$p2 -> r3res = null;
				if ($color1 == 'white') {
					$p1 -> r3color = 'white';
					$p2 -> r3color = 'black';								
				} else {
					$p2 -> r3color = 'white';
					$p1 -> r3color = 'black';					
				}
				break;			
		}
		$p1 -> plaing = true;
		$p2 -> plaing = true;
		R::store($p1);
		R::store($p2);
		R::store($game);

		return true;
	}
}


$all_points = R::getCol('SELECT DISTINCT `points` FROM `battle` WHERE `status`>0 AND `plaing` = false ORDER BY `points` DESC');
$board_num=1;
$col_in=1;
foreach ($all_points as $point) {
	$num=R::count('battle','status > 0 AND `plaing` = false AND `points` = ?',[$point]);

	if ($num <= 1){
		$d=1;
	} else {
		$d=intdiv($num,2);
	}
	
	$up = R::getCol('SELECT `id` FROM `battle` WHERE `status`>0 AND `points` = ? AND `plaing` = false ORDER BY `place` ASC LIMIT ?',[$point,$d]);
	$bottom = R::getCol('SELECT `id` FROM `battle` WHERE `status`>0 AND `points` = ? AND `plaing` = false ORDER BY `place` ASC LIMIT ?,?',[$point,$d,$d]);
	$que = array_merge($bottom,$up);
	$que2 = array_merge($up,$bottom);//main array

	if (isset($odd)) {		
		$num++;		
		$que2 = array_merge($odd,$que2);
		$odd=array();
	}


	if ($num%2==1){
		$num--;
		$odd=R::getCol('SELECT `id` FROM `battle` WHERE `status`>0 AND `points` = ? AND `plaing` = false ORDER BY `place` DESC LIMIT 1',[$point]);			
	}

			echo "points:".$point;			
			echo "odd------------";
			print_r($odd);
			echo "que------------";
			print_r($que);
			echo "que2------------";
			print_r($que2);		

	foreach ($que2 as $p1) {
		if ($col_in%2==1) {
			$color = 'white';
		} else {
			$color = 'black';			
		}
			$col_in++;
		foreach ($que as $p2) {
			if (match($color,$p1,$p2,$board_num)){
				$board_num++;
				break;
			}
		}
	}
}


#print_r($round);

 ?>
 	
 </pre>