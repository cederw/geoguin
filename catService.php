<?php
	header('Content-Type: application/json');
	include("mysql_connect.php");
	$userID = $_GET['userid'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$dbh = getDB();

	//give money
	// $stmt = "INSERT INTO money (userID, catID, amount) SELECT u.id, c.id, '".rand(10,100)."' FROM user u JOIN cat c ON c.userID = u.id  WHERE c.timeout > NOW()";
	// $dbh->exec($stmt);


	// get timeout cats and give user money for each one
	$stmt = "SELECT c.id as catid, c.userID FROM cat c, user u WHERE c.userID = $userID AND c.userID = u.id AND c.timeout < NOW()";
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$randMoney = rand(0, 100);
		$cid = $row["catid"];
		$insert = "INSERT INTO money (userID, catID, amount) VALUES ($userID, $cid, $randMoney)";
		$dbh->exec($insert);
	}
	

	//timeout cats
	$stmt = "UPDATE cat SET userID=NULL, timeout=NULL WHERE timeout < NOW() AND userID = $userID";
	$dbh->exec($stmt);	

	// JSON to return
	$json = array();

    $stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c JOIN user u ON c.userID = u.id WHERE u.id = ".$userID;
	// insert one row	
	foreach ($dbh->query($stmt) as $row) {
		$allCats[] = $row;
	}
	if (count($allCats) > 0) 
	 	$json["cats"] = $allCats;

	$stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c  WHERE (".$lat." BETWEEN lat - 0.0001 AND lat + 0.0001) AND (".$lon." BETWEEN lon - 0.0001 AND lon + 0.0001) AND userID IS NULL";
	// insert one row	
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$newCats[] = $row;
	}

	if (count($newCats) > 0){
		$k = array_rand($newCats);
		$v = $newCats[$k];
		$stmt = "UPDATE cat SET userID=".$userID.", timeout=NOW() + INTERVAL 2	 HOUR WHERE id = ".$v['id'];
		$dbh->exec($stmt);	
		$json["new"] = $v;
		$catID = $v["id"];
	}

	//give the user the money they have earned
	$stmt = "UPDATE user u  JOIN money m ON m.userID = u.id SET u.money=u.money+m.amount WHERE u.id = ".$userID;
	$dbh->exec($stmt);

	//find all the records for the money the user is getting
	// $stmt = "SELECT c.name, m.amount FROM cat c JOIN money m ON m.catID = c.id"; for testing purposes
	$stmt = "SELECT c.name, m.amount FROM cat c JOIN money m ON m.catID = c.id WHERE m.userID = ".$userID;
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$newMoney[] = $row;
	}

	if(count($newMoney)>0){		
		$json["money"] = $newMoney;
		//remove the displayed records
		$stmt = "DELETE FROM money WHERE userID = $userID";
		$dbh->exec($stmt);
	}

	print json_encode($json);
?>
