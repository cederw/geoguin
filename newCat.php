<?php
//new cat
include("mysql_connect.php");
	$name = $_GET['name'];
	$desc = $_GET['desc'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$dbh = getDB();

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}
	$money = $_SESSION["money"];
	$userID = $_SESSION["userID"];
	if($money>=100){
		$_SESSION["money"] = $_SESSION["money"] - 100;

	$stmt = "UPDATE user SET money=money-100 WHERE id = ".$userID;
	$dbh->exec($stmt);

	$url;
	$stmt = "SELECT url FROM cat ORDER BY RAND() LIMIT 1;";
	$rows = $dbh->query($stmt);
	foreach ($rows as $row) {
		$url = $row['url'];
	}
	

	$stmt = "INSERT INTO cat (lat, lon, name, `desc`, url, userID, timeout) VALUES (".$lat.",".$lon.",'".$name."','".$desc."','".$url."',".$userID.", NOW() + INTERVAL 2 HOUR)";
	$dbh->exec($stmt);
	}
	header("Location: cats.php");
	
//check if the user has enough money
//update the money
//insert the cat at current location

//header to cats

//dont let dremes be memes

?>