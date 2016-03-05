<?php
	header('Content-Type: application/json');
	include("mysql_connect.php");
	$userID = $_GET['userid'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$dbh = getDB();

	$userID = htmlspecialchars($userID);

	$quserID = $dbh->quote($userID);
	$qlat = $dbh->quote($lat);
	$qlon = $dbh->quote($lon);

	// get timeout cats and give user money for each one
	$stmt = "SELECT c.id as catid, c.userID FROM cat c, user u WHERE c.userID = $quserID AND c.userID = u.id AND c.timeout < NOW()";
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$randMoney = rand(0, 100);
		$cid = $row["catid"];
		$insert = "INSERT INTO money (userID, catID, amount) VALUES ($quserID, $cid, $randMoney)";
		$dbh->exec($insert);
	}
	

	// timeout cats
	// but only for current user (for teh efficiency)
	$stmt = "UPDATE cat SET userID=NULL, timeout=NULL WHERE timeout < NOW() AND userID = $quserID";
	$dbh->exec($stmt);	

	// JSON to return
	$json = array();

    $stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c JOIN user u ON c.userID = u.id WHERE u.id = $quserID";
	// insert one row	
	foreach ($dbh->query($stmt) as $row) {
		$allCats[] = $row;
	}
	if (count($allCats) > 0) 
	 	$json["cats"] = $allCats;

	$stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c  WHERE ($qlat BETWEEN lat - 0.0005 AND lat + 0.0005) AND ($qlon BETWEEN lon - 0.0005 AND lon + 0.0005) AND userID IS NULL";
	// insert one row	
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$newCats[] = $row;
	}

	if (count($newCats) > 0){
		$k = array_rand($newCats);
		$v = $newCats[$k];
		$stmt = "UPDATE cat SET userID=$quserID, timeout=NOW() + INTERVAL 2	 HOUR WHERE id = ".$v['id'];
		$dbh->exec($stmt);	
		$json["new"] = $v;
		$catID = $v["id"];
	}

	//give the user the money they have earned
	$stmt = "UPDATE user u  JOIN money m ON m.userID = u.id SET u.money=u.money+m.amount WHERE u.id = $quserID";
	$dbh->exec($stmt);

	//find all the records for the money the user is getting
	// $stmt = "SELECT c.name, m.amount FROM cat c JOIN money m ON m.catID = c.id"; for testing purposes
	$stmt = "SELECT c.name, m.amount FROM cat c JOIN money m ON m.catID = c.id WHERE m.userID = $quserID";
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$newMoney[] = $row;
	}

	if(count($newMoney)>0){		
		$json["money"] = $newMoney;
		//remove the displayed records
		$stmt = "DELETE FROM money WHERE userID = $quserID";
		$dbh->exec($stmt);
	}

	print json_encode($json);
?>
