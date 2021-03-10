<pre>
<?php 
require "../db.php";
	#$user=$_SESSION['logged_user'];





$users=R::findall( 'users' );
foreach ($users as $user) {
	if ( $user -> status == 'active' ){
		$pl = R::findOrCreate('battle',['users_id' => $user[id]]);
		$pl -> status = 1;
		$pl -> teams_id = $user -> teams_id;		
				
	} else {
		R::find('battle',['users_id' => $user[id]]);
		$pl -> status = 0; 
	}
	R::store($pl);
	R::store($user);
}


 ?>
</pre>