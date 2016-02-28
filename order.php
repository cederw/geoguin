<?php 

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}

	include("common.php");
	open(true);
?>

<div class="container">
<form action="newCat.php">
  <input type="text" name="name" value="Name">
  <input type="text" name="desc" value="Description">
  <input id = "lat" type="hidden" name="lat" value="">
  <input id = "lon" type="hidden" name="lon" value="">
  <input type="submit" value="Submit">
</form>
</div>

<script>
getLoc();
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
  }
</script>
<?php
	close();
?>
