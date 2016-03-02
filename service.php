<?php
	include("mysql_connect.php");

	$userID = $_GET["userID"];
	$mode = $_GET["mode"];
	$lat = $_GET["lat"];
	$lon = $_GET["lon"];


	if (!isset($mode)) {
		die();
	} 

	$dbh = getDB();

	if ($mode == "money") {
		$stmt = "SELECT money FROM user WHERE id = '$userID'";
		$rows = $dbh->query($stmt);
		foreach ($rows as $row) {
			$_SESSION["money"] = $row["money"];
			print $row["money"];
		}
		die();
	}

	if ($mode == "location" && isset($lat) && isset($lon)) {
		$stmt = "SELECT * FROM cat c  
		WHERE (".$lat." BETWEEN lat - 0.01 AND lat + 0.01) AND (".$lon." BETWEEN lon - 0.01 AND lon + 0.01)";
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