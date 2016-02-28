<?php 

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}
	$userID = $_SESSION["userID"];

	include("nav.php");

?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<head>
		<?php include("head.php"); ?>
		
    	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script type="text/javascript" src="map.js"></script>
	</head>

	<body ng-controller="CatCtrl">
		<?php nav(true, false); ?>

		<div class="container" id="cat-container">
			 <div id="map_canvas"></div>
		</div>
	</body>
<html>
