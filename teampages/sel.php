<?php
 require "../db.php";
#var_dump($_POST);
 $data=$_POST; 
#var_dump($data);
 $team=R::findone('teams','id = ?', [$data['id']]);
#var_dump($team);
 foreach ($team as $value) {
 	echo $value.'; ';
 }