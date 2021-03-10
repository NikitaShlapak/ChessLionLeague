<?php
	require "../db.php";
	$user=$_SESSION['logged_user'];
	$user -> status = 'passive';
	R::store($user);
	
	header('location: ../profile.php');