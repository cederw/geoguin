<?php
	include("mysql_connect.php");
	$mode = $_GET["mode"];
	$userID = $_GET["userID"];
	$lat = $_GET["lat"];
	$lon = $_GET["lon"];


	if (!isset($mode)) {
		die();
	} 

	$dbh = getDB();

	$quserID = $dbh->quote($userID);
	$qlat = $dbh->quote($lat);
	$qlon = $dbh->quote($lon);

	if ($mode == "money") {
		$stmt = "SELECT money FROM user WHERE id = $quserID";
		$rows = $dbh->query($stmt);
		foreach ($rows as $row) {
			$_SESSION["money"] = $row["money"];
			print $row["money"];
		}
		die();
	}

	if ($mode == "location" && isset($lat) && isset($lon)) {
		$stmt = "SELECT * FROM cat c  
		WHERE ($qlat BETWEEN lat - 0.5 AND lat + 0.5) AND ($qlon BETWEEN lon - 0.5 AND lon + 0.5)";
		// insert one row	
		$rows = $dbh->query($stmt);
		$owned = array();
		$free = array();
		foreach ($rows as $row) {
			if (!is_null($row["userID"])) {
				$owned[] = $row;
			} else {
				$free[] = $row;
			}
		}
		$json = array();
		$json["owned"] = $owned;
		$json["free"] = $free;
		header('Content-Type: application/json');

		print json_encode($json);
		die();
	}
?>