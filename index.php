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
<html>
	<head>
		<?php include("head.php"); ?>
		<!-- <script src="http://maps.googleapis.com/maps/api/js"></script> -->
	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsEOBEHWnYx80lrABX6ngLFZO73bwoMRU"></script>
		<script type="text/javascript" src="map.js"></script>
	</head>

	<body>
		<?php nav(false, false); ?>
		<div id="map-wrapper">
			<div id="googleMap" style="width:100vw;height:100vh"></div>

			<div id="map-overlay" class="container">
					<?php
						if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
					?>
						<div class="text-center alert alert-danger col-lg-6 col-lg-offset-3" role="alert">Wrong password. Please try again</div>
					<?php
						}
					?>
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h1 id="header">the catvenger hunt</h1>
					</div>
					<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
						
						<!-- <div class="row"> -->
						
							<form class="form-group text-center" action="validate.php" method="POST">
								<input class="form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="text" name="user" placeholder="Username" />
								<input class="has-error form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="password" name="password" placeholder="Password" />
								<button class="btn btn-default" id="submit" type="submit">Login</button>
							</form>
						<!-- </div> -->
					</div>
				<!-- 	<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
						<em>thecatvengerhunt needs location services to be allowed in order to work</em>
					</div> -->
				</div>
			</div>
		</div>
	</body>
<html>
