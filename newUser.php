<?php 
	session_start();
	include("nav.php");

	if (!isset($_SESSION["create"]) || !$_SESSION["create"]) {
		header("Location: cats.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("head.php"); ?>
	</head>

	<body ng-controller="CatCtrl">
		<?php
			nav(true, false);
		?>
	    <div class="container">
		    <div class="row">
				<div class="row">
					<h1 id="header">Create a new account</h1>
				</div>
				<div class="col-md-4 col-md-offset-4">

					<div class="row">
						<form class="form-group text-center" action="newUser-submit.php" method="POST">
							<input class="form-control" type="text" name="name" placeholder="Name" />
							<textarea class="form-control" name="desc" placeholder="A description of yourself"></textarea>
							<input id="lat" class="form-control" type="hidden" name="lat" placeholder="latitude" />
							<input id="lon" class="form-control" type="hidden" name="lon" placeholder="longitude" />
							
							<button class="btn btn-default" id="submit" type="submit">Submit</button>
						</form>
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

