<?php 

	session_start();
	if (!isset($_SESSION["user"]) || !isset($_SESSION["userID"])) {
		$loggedin = false;
	} else {
		$loggedin = true;
	}


	include("nav.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<?php include("head.php"); ?>
	
	</head>

	<body>
		<?php nav($loggedin, false); ?>

		<div class="container">
			<div class="row">
			
				<div class="col-md-4 col-md-offset-4">
				
					<div class="row">
						<h1 id="header">about us</h1>
						<p>thecatvengerhunt was created by <a href="students.washington.edu/helenung">helen ung</a>, <a href="http://walterceder.me/">walter ceder</a>, and tiffany chen on february 27, 2016 during <a href="https://www.nwhacks.io/">nwhacks</a>, western canada's largest hackathon.</p>
						<p>thecatvengurehunt is a web app optimized for mobile use. users are visited by cats as they move from location to location, and can play with the cats for as long as the cat stays. cats leave currency, which users can then use to order more cats.</p>
						<p>the goal: fill the world with cats. or, try to collect them all. use our <a href="map.php">handily-provided map</a> to find them all!</p>
					</div>
				</div>
			</div>
		</div>
	</body>
<html>
