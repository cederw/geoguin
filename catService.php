<?php
	header('Content-Type: application/json');
	include("mysql_connect.php");
	$userID = $_GET['userid'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$dbh = getDB();

	$stmt = "UPDATE cat SET userID=NULL, timeout=NULL WHERE timeout < NOW()";
	$dbh->exec($stmt);	

    $stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c JOIN user u ON c.userID = u.id WHERE u.id = ".$userID;
	// insert one row	
	foreach ($dbh->query($stmt) as $row) {
		$allCats[] = $row;
	}

	$stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c  WHERE (".$lat." BETWEEN lat - 0.0001 AND lat + 0.0001) AND (".$lon." BETWEEN lon - 0.0001 AND lon + 0.0001) AND userID IS NULL";
	// insert one row	
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$newCats[] = $row;
	}

	$json = array();
 	$json["cats"] = $allCats;

	if(count($newCats)>0){
		$k = array_rand($newCats);
		$v = $newCats[$k];
		$stmt = "UPDATE cat SET userID=".$userID.", timeout=NOW() + INTERVAL 6 HOUR WHERE id = ".$v['id'];
		$dbh->exec($stmt);	
		$json["new"] = $v;
	}
	print json_encode($json);
?>
