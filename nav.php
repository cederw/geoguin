<?php
	// $cats tells whether or not we are on cats.php
	// $loggedin says whether or not we are logged in
    function nav($loggedin, $cats) { 
    	session_start();
    	$user = $_SESSION["user"];
        $money = $_SESSION["money"];
?>

<nav id="cat-nav" class="navbar navbar-default">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <?php
        	if ($loggedin) { 
		?>
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        </button>
	        <?php 
	        }
	        ?>
	        <a <?php 
            $loc = "index.php";
            if($cats) { $loc="#"; ?>ng-click="home()"<?php }  ?> class="navbar-brand" href="<?=$loc?>">the catvenger hunt</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
     
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
        	   <?php 
        			if ($cats) { 
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img id="exclaim" src="img/catcoin_icon.png" ng-click="openNotif()" ng-show="notif" alt="cat coin" />{{user}} (<img src='img/catcoin.png'>{{money}})<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a ng-click="openNotif()" href="#">Notifications</a></li>
                        <li><a id="order" href="order.php">Order a Cat</a></li>
                        <li><a id="scout" href="map.php">Cat Scouter</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="password.php">Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><audio controls autoplay>
                          <source src="happy_0.mp3" type="audio/mpeg">
                          Your browser does not support the audio element.
                        </audio> </li>
					</ul>
				</li>
				<?php 
			        } else if ($loggedin) {
	        	?>
        		<li><a href="cats.php">Back</a></li>
    			<?php
			        }
			    ?>
        	</ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<?php
    }
?>