<div class="row">
	<div class="col-lg-4 col-lg-offset-4">
		<form class="form-group text-center" action="validate.php" method="POST">
			<input class="form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="text" name="user" placeholder="Username" />
			<input class="has-error form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="password" name="password" placeholder="Password" />
			<button class="btn btn-default" type="submit">Login</button>
		</form>
	</div>
</div>