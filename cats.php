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

		<div id="area">
			<img id="neko" src="penguin.jpg" />
		</div>

<?php
	close();
?>
