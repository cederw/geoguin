<?php
	include("mysql_connect.php");

	session_start();
	$user = $_SESSION["user"];
	$password = $_POST["password"];
	$newpassword = $_POST["newpassword"];
	$retype = $_POST["retype"];

	if (!isset($password) || !isset($newpassword) || !isset($retype)) {
		$SESSION["error"] = "A parameter not set";
		header("Location: password.php");
		die();
	}

	if ($password == "" || $newpassword == "" || $retype == "") {
		$_SESSION["error"] = "Please fill in all fields";
		header("Location: password.php");
		die();
	}

	$pw = htmlspecialchars($password);
	$conn = getDB();
	$qpw = $conn->quote($pw);
	$newpw = htmlspecialchars($newpassword);
	$qnewpw = $conn->quote($newpw);
	$quser = $conn->quote($user);

	try {
		$stmt = "SELECT * FROM user WHERE name = $quser";
		$rows = $conn->query($stmt);
		if ($rows->rowCount() == 0) {
			header("Location: password.php?fail=true");
			die();
		} else {
			foreach ($rows as $row) {
				$thispw = $row["password"];
				if ($thispw == $pw) {
					if ($newpassword == $retype) {
						$stmt = "UPDATE user SET password = $qnewpw WHERE name = $quser";
						$conn->exec($stmt);
						$_SESSION["success"] = "Password was successfully changed!";
					} else {
						$_SESSION["error"] = "Passwords do not match";
						
					}
					header("Location: password.php");
					die();
				} 
			}
			$_SESSION["error"] = "Incorrect password";
			header("Location: password.php");
			die();
		}
	} catch (PDOException $ex) {
		header("Location: password.php?fail=dberror");
		die();
	} 
?>