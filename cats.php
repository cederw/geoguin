<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
	<?php 
		include("head.php");

		if (isset($_SESSION["user"])) {
			$user = $_SESSION["user"];
			?>
			welcome <?=$user?>!
			<?php
		}
	?>

	<body>
		<div id="header">the catvenger hunt</div>
		<div id="area">
			<img id="neko" src="penguin.jpg" />
		</div>
	</body>
<html>

