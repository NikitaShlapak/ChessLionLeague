<?php  

#echo '<pre>';
 $allteams = R::getall('SELECT `id`,`members` FROM `teams`');
 
 $allteams = R::convertToBeans( 'teams' ,$allteams);
 
 foreach ($allteams as $team) {
 	$team['members'] = $team-> countOwn('users');  	
 };

R::storeall($allteams);


?>