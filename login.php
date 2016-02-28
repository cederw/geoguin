<div class="row">
<form class="form-group" action="validate.php" method="POST">
	<input class="form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="text" name="user" placeholder="Username" />
	<input class="has-error form-control <?php if ($_GET["fail"] == true) { ?>has-error<?php } ?>" type="password" name="password" placeholder="Password" />
	<button class="btn btn-default" type="submit">Login</button>
</form>
</div>