<?php 
	session_start();
	include("nav.php");

	if (!isset($_SESSION["user"])) {
		header("Location: index.php");
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
		    		<?php
						if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
					?>
						<div class="text-center alert alert-danger col-lg-6 col-lg-offset-3" role="alert">There was an error. Please try again</div>
					<?php
						} else if (isset($_SESSION["error"])) {
					?>
						<div class="text-center alert alert-danger col-lg-6 col-lg-offset-3" role="alert">Error: <?=$_SESSION["error"]?></div>
					<?php
							unset($_SESSION["error"]);
						} else if (isset($_SESSION["success"])) {
					?>
						<div class="text-center alert alert-success col-lg-6 col-lg-offset-3" role="alert"><?=$_SESSION["success"]?></div>	
					<?php
							unset($_SESSION["success"]);
						}


					?>
				<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
					<h1 id="header">Update password</h1>
				</div>
				<div class="col-md-4 col-md-offset-4">

					<div class="row">
						<form class="form-group text-center" action="password-submit.php" method="POST">
							<input class="form-control" type="password" name="password" placeholder="Current password" />
							<input class="form-control" type="password" name="newpassword" placeholder="New password" />
							<input class="form-control" type="password" name="retype" placeholder="Retype password" />
							
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

