<?php
$alltours=R::findall('tournaments'); //past tournaments update
foreach ($alltours as $tour) {
	if ( ($tour -> status !=  0) and ($tour -> date <= date('Y-m-d') ) ){
		$tour -> status =  0;
		R::store($tour);
	}
}
?>