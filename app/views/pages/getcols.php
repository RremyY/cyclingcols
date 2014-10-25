<?php 
	$cols = DB::table('cols')->select('ColID','ColIDString','Col','Latitude','Longitude','Height')->get();
	echo json_encode($cols);
?>