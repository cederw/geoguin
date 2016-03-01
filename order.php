<?php 

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}

	include("common.php");
?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<head>
		<?php include("head.php"); ?>
		<script type="text/javascript" src="map.js"></script>
	</head>

	<body ng-controller="CatCtrl">
		<?php nav(true, false); ?>

		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="row">
						<h1>Order a cat!</h1>
					</div>
					<div class="row">
					<?php 
						if (isset($_SESSION["money"]) && $_SESSION["money"] >= 100) { ?>
						<form class="form-group" action="newCat.php">
							<input class="form-control" type="text" name="name" placeholder="Name" />
							<textarea class="form-control" name="desc" placeholder="Description"></textarea> 
							<input id = "lat" type="hidden" name="lat" value="" />
							<input id = "lon" type="hidden" name="lon" value="" />
							<input class="form-control" id="submit" type="submit" value="Submit" />
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

<script>
getLoc();
$("#submit").attr("disabled", "disabled");
function getLoc() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(insertCoords);
      } else { 
          console.log("Geolocation is not supported by this browser.");
      }
  }
  function insertCoords(position) {
    $("#lat").val(position.coords.latitude);
    $("#lon").val(position.coords.longitude);
    $("#submit").removeAttr("disabled");
  }
</script>

