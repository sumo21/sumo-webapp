<?php
	header('Content-type: application/json');

	
	if (!is_null($_POST)) {
		
		$usState = $_POST['usState'];
		$capital = $_POST['capital'];
		$abbr = $_POST['abbr'];
		
		$query = 'SELECT * FROM insertState(\''. $usState .'\', \''. $capital .'\', \''. $abbr .'\');';
	
		try {

			$db = pg_connect("host=" . $params['host'] . " dbname=" . ltrim($params['path'], '/') . " user=" . $params['user'] . " password=" . $params['pass']);

		}catch(Exception $e){
			print_r('Exception:  ' . $e);
		}
		
		$res = pg_query($db, $query);

		while($row = pg_fetch_array($res)) {
			$newRecId = $row[0];
		}
		
		$results['success'] = 1;
		$results['recordId'] = $newRecId;
		
		$redUrl = 'https://sumo-webapp.herokuapp.com/web/states.html';

	} else {
		$results['success'] = 0;
		$redUrl = 'https://sumo-webapp.herokuapp.com/web/dummy.html';
	}
		

	echo json_encode($response);
	
	header('Location:' . $redUrl);
	exit;

?>