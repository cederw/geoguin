<?php
	include("nav.php");
	function open($logout) { 
?>

<!DOCTYPE html>
<html>
	<?php include("head.php"); ?>

	<body>
		<?php nav($logout); ?>
		<div class="container-fluid">
		<?php
	}

	function close() { ?>
		</div>
	</body>
<html>
	<?php
	}
?>


