<?php
	header('Content-type: application/json');
	
	$params = parse_url(getenv("DATABASE_URL"));

	
	if (!is_null($_POST)) {
		
		$usState = $_POST['usState'];
		$capital = $_POST['capital'];
		$abbr = $_POST['abbr'];
		
		$query = 'SELECT insertState(\''. $usState .'\', \''. $capital .'\', \''. $abbr .'\') AS id;';
	
		try {


			$db = pg_connect("host=" . $params['host'] . " dbname=" . ltrim($params['path'], '/') . " user=" . $params['user'] . " password=" . $params['pass']);

		}catch(Exception $e){

			print_r('Exception:  ' . $e);

		}
		
		$res = pg_query($db, $query);

		while($row = pg_fetch_array($res)) {
			$newRecId = $row['id'];
		}
		
		$results['success'] = 1;
		$results['recordId'] = $newRecId;
		
	} else {

		$results['success'] = 0;

	}

	$redUrl = 'https://sumo-webapp.herokuapp.com/web/states.html';

	header('Location:' . $redUrl);

	exit;

?>