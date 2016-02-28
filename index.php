<?php
	session_start();
	if (isset($_SESSION["user"])) {
		header("Location: cats.php");
		die();
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Not Neko Atsume</title>
		<link href="catvenger.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="catvenger.js" type="text/javascript"></script>
	</head>

	<body>
		<div class="container-fluid">
			<div class="navbar-header" id="header">the catvenger hunt</div>
			<?php 
				if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
			?>
			<div class="row">you failed</div>
			<?php
				}

				include("login.php");
			?>
		</div>
	</body>
<html>

