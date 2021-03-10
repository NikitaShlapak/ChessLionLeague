<?php
	require "../db.php";
	#echo "test";
	$user=$_SESSION['logged_user'];
	$user -> status = 'active';
	R::store($user);
	/*$player = R::findone( 'players', 'name = ?', [$user -> login]);
	if (isset($player)){

	} else*/ {
		
	}
	
	
	
	header('location: ../profile.php');