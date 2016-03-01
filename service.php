<?php
	include("mysql_connect.php");
	session_start();

	$userID = $_GET['userID'];
	$mode = $_GET["mode"];


	if (isset($mode) && $mode = "money") {
		$dbh = getDB();
		$stmt = "SELECT money FROM user WHERE id = '$userID'";
		$rows = $dbh->query($stmt);
		foreach ($rows as $row) {
			$_SESSION["money"] = $row["money"];
			print $row["money"];
		}
	}
?>