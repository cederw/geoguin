<?php
	include("mysql_connect.php");
	// validate the user
	// if validated user, then goes back to index.php with credentials
	$user = htmlspecialchars($_POST["user"]);
	$pw = htmlspecialchars($_POST["password"]);
	$conn = getDB();
	try {
		$stmt = "SELECT * FROM user WHERE name = '" . $user . "'";
		$rows = $conn->query($stmt);
		$count = $rows->rowCount();
		if ($count == 0) {
			// add user
			$sql = "INSERT INTO user (name, password) 
					VALUES ('" . $user . "', '" . $pw . "')";
			$conn->exec($sql);
		} else {
			$found = false;
			foreach ($rows as $row) {
				if ($row["name"] == $user && $row["password"] == $pw) {
					$found = true;
				}
			}
			if (!$found) {
				 header("Location: index.php?fail=true");
				 die();
			} 
		}
	
		session_start();
		$_SESSION["user"] = $user;
		header("Location: cats.php");
		die();

	} catch (PDOException $ex) {
		header("Location: index.php?fail=dberror");
		die();
	} 
?>