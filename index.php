<?php 
	session_start();
	$user = $_SESSION["user"];
	if (isset($_SESSION["user"])) {
		header("Location: cats.php");
		die();
	}

	include("nav.php");

?>
<!DOCTYPE html>
<html ng-app="catvenger">
	<head>
		<?php include("head.php"); ?>
		<script type="text/javascript" src="map.js"></script>
	</head>

	<body ng-controller="CatCtrl">
		<?php nav(false, true); ?>

		<div class="container">
		<?php
			if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
		?>
			<div class="alert alert-danger col-lg-6 col-lg-offset-3" role="alert">Wrong password. Please try again</div>
		<?php
			}
		?>
			</div>
		<?php
			include("login.php");
		?>
	</body>
<html>
