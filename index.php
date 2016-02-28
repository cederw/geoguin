<?php
	session_start();
	if (isset($_SESSION["user"])) {
		header("Location: cats.php");
		die();
	}
	include("common.php");


	open(false);
?>

	<div class="container">
<?php
	if (isset($_GET["fail"]) && $_GET["fail"] == "true") {
?>
	<div class="alert alert-danger col-lg-6 col-lg-offset-3" role="alert">Wrong password. Please try again</div>
<?php
	}
?>
	</div>
<?php
	include("login.php");
	close();
?>
