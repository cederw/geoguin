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
  <input type="submit" value="Submit">
</form>
</div>


<?php
	close();
?>
