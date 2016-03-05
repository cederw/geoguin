<?php 

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}

	if (isset($_GET["fail"])) {
		$fail = true;
	} else {
		$fail = false;
	}

	include("common.php");
?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<head>
		<?php include("head.php"); ?>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script type="text/javascript" src="order.js"></script>
	</head>

	<body ng-controller="CatCtrl">
		<?php nav(true, false); ?>

		<div class="container">
			<div class="row">
				<?php if ($fail) { ?>
				<div class="col-lg-12 col-mg-12 text-center alert alert-danger col-lg-6 col-lg-offset-3" role="alert">There was an error. You probably missed a field or didn't choose a location. Please try again</div> <?php } ?>
				<div class="col-lg-12 col-mg-12 ">
					<h1 id="header">Order a cat!</h1>
				</div>
				<div id="googleMap" style="width:100%;height:80vh;"></div>

				<div class="col-md-4 col-md-offset-4">
				
					<div class="row">
					<?php 
						if (isset($_SESSION["money"]) && $_SESSION["money"] >= 100) { ?>
						<form class="form-group text-center" action="newCat.php" method="POST">
							<input class="form-control" type="text" name="name" placeholder="Cat Name" />
							<textarea class="form-control" name="desc" placeholder="Cat Description"></textarea> 
							<input class="form-control" id="lat" type="hidden" name="lat" value="" />
							<input class="form-control" id="lon" type="hidden" name="lon" value="" />
							<button class="btn btn-default" id="submit" type="submit">Submit</button>
						</form>
					<?php } else if (isset($_SESSION["money"])) { ?>
						You don't have enough money to order a cat! You need at least 100. You have <?= $_SESSION["money"] ?>.
					<?php } else { ?>
						You don't have enough money to order a cat! You need at least 100.
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

