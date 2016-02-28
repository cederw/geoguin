<?php
    function nav($logout) { 
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <?php
        	if ($logout) { 
		?>
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        </button>
	        <?php 
	        }
	        ?>
	        <a class="navbar-brand" href="#">the catvenger hunt</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php 
        if ($logout) { ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="logout.php">Logout</a>
                </li>
        	</ul>
        </div><!-- /.navbar-collapse -->
    <?php 
        }
    ?>
    </div><!-- /.container-fluid -->
</nav>

<?php
    }
?>