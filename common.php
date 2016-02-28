<?php
	include("nav.php");
	function open($logout) { 
?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<?php include("head.php"); ?>

	<body ng-controller="CatCtrl">
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


