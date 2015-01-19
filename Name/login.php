<?php require "header.php" ?>
<?php require "navbar.php" ?>
<div class="container">
<div class="col-sm-4">
	<form action="./_login.php" method="POST" role="form">

		<div class="form-group"><label>Username</label><input class="txtbox form-control" type="text" id="username" name="username" required></div>

		<div class="form-group"><label>Password</label><input class="txtbox form-control" type="password" id="password" name="password" required></div>


		<button type="submit" class="btn btn-default"> Submit </button>
		<button type="reset" class="btn btn-default" value="Reset"> Clear </button>
	</form>
</div>

		<?php




		?>

</div>


<?php require "footer.php" ?>