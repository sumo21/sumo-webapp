<?php
	header('Content-type: application/json');

	$params = parse_url(getenv("DATABASE_URL"));

	$results = array();
	$records = array();
	
	try {

		$db = pg_connect("host=" . $params['host'] . " dbname=" . ltrim($params['path'], '/') . " user=" . $params['user'] . " password=" . $params['pass']);

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