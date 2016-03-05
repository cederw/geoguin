<?php
//new cat
	include("mysql_connect.php");
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$dbh = getDB();

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
		die();
	}

	if ($lat == "" || $lon == "") {
		header("Location: order.php?fail=true");
		die();
	}

	$name = htmlspecialchars($name);
	$desc = htmlspecialchars($desc);
	$name = preg_replace("/'/", "\'", $name);
	$desc = preg_replace("/'/", "\'", $desc);

	$qlat = $dbh->quote($lat);
	$qlon = $dbh->quote($lon);
	$quserID = $dbh->quote($userID);
	$qname = $dbh->quote($name);
	$qdesc = $dbh->quote($desc);

	$money = $_SESSION["money"];
	$userID = $_SESSION["userID"];
	if($money>=100){
		$_SESSION["money"] = $_SESSION["money"] - 100;
	} else {
		// sanity check; user shouldn't be able to submit a form if
		// they don't have enough money
		header("Location: cats.php");
	}

	$stmt = "UPDATE user SET money=money-100 WHERE id = $quserID";
	$dbh->exec($stmt);

	$urlArr = glob("img/*_hang.png");
	$url = $urlArr[array_rand($urlArr)];
	$url = preg_replace("/_hang\.png$/", ".png", $url);
	$qurl = $dbh->quote($url);

	$stmt = "INSERT INTO cat (lat, lon, name, `desc`, url, userID, timeout) VALUES ($qlat, $qlon, $qname, $qdesc, $qurl, $quserID, NOW() + INTERVAL 2 HOUR)";
	$dbh->exec($stmt);

	// finished, so go back to home
	header("Location: cats.php?dontletdremesbememes");
	
//check if the user has enough money
//update the money
//insert the cat at current location

//header to cats

//dont let dremes be memes

?>