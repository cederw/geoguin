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
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script type="text/javascript" src="map.js"></script>
	</head>

	<body>
		<?php nav(false, false); ?>
		<div id="map-wrapper">
			<div id="googleMap" style="width:100vw;height:100vh"></div>

			<div id="map-overlay" class="container">
				<div class="row">
					<?php
						if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
					?>
						<div class="col-lg-12 col-md-12 text-center alert alert-danger col-lg-6 col-lg-offset-3" role="alert">Wrong password. Please try again</div>
					<?php
						}
					?>
					<div class="row">
						<h1 id="header">the catvenger hunt</h1>
					</div>
					<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
						
						<div class="row">
						
							<form class="form-group text-center" action="validate.php" method="POST">
								<input class="form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="text" name="user" placeholder="Username" />
								<input class="has-error form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="password" name="password" placeholder="Password" />
								<button class="btn btn-default" id="submit" type="submit">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<html>
