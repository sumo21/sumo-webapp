<?php
	header('Content-type: application/json');

	$results = array();
	$records = array();
	
	try {
		$db = pg_connect("host=localhost dbname=postgres user=postgres password=F3$73r_@");

	}catch(Exception $e){
		print_r('Exception:  ' . $e);
	}

	$query = 'SELECT * FROM getStates();';

	$res = pg_query($db, $query);

	while($row = pg_fetch_array($res)) {
		array_push($records, $row);
	}

	$results['success'] = 1;
	$results['records'] = $records;
	
	
	echo json_encode($results);

?>