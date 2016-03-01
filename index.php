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
		<?php nav(false, false); ?>



		<div class="container">
			<div class="row">
				<?php
					if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
				?>
					<div class="alert alert-danger col-lg-6 col-lg-offset-3" role="alert">Wrong password. Please try again</div>
				<?php
					}
				?>

				<div class="col-md-4 col-md-offset-4">
					<div class="row">
						<h1>the catvenger hunt</h1>
					</div>
					<div class="row">
					
						<form class="form-group text-center" action="validate.php" method="POST">
							<input class="form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="text" name="user" placeholder="Username" />
							<input class="has-error form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="password" name="password" placeholder="Password" />
							<button class="btn btn-default" type="submit">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
<html>
