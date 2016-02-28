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

	if($money)>=100;
	$_SESSION["money"] = $_SESSION["money"] - 100;

	$stmt = "UPDATE user u   SET u.money=u.money-100 WHERE u.id = ".$userID;
	$dbh->exec($stmt);

	$stmt = "INSERT INTO cat (lat, lon, name, desc, url, userID, timeout) VALUES ".$lat.",".$lon.",".$name.",".$desc.","."img/trump.jpg".",".$userID.", NOW() + INTERVAL 6 HOUR";
	$dbh->exec($stmt);
//check if the user has enough money
//update the money
//insert the cat at current location

//header to cats

//dont let dremes be memes

?>