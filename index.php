<?php
	session_start();
	if (isset($_SESSION["user"])) {
		header("Location: cats.php");
		die();
	}
	include("common.php");


	open(false);
	if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
?>
	<div class="alert alert-danger" role="alert">Wrong password. Please try again</div>
<?php
	}
	include("login.php");
	close();
?>
