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
	<div class="row">you failed</div>
<?php
	}
	include("login.php");
	close();
?>
