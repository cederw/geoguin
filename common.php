<?php
	include("nav.php");
	function open($logout) { 
?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<?php include("head.php"); ?>

	<body ng-controller="CatCtrl">
		<?php nav($logout); 
	}

	function close() { ?>
	</body>
<html>
	<?php
	}
?>


