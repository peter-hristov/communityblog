<?php require "header.php" ?>
<?php require "navbar.php" ?>
<div class="container">
<div class="col-sm-4">
	<form action="./_create.php" method="POST" role="form">

		<div class="form-group"><label>Building</label><input class="txtbox form-control" type="text" id="name" name="name" required></div>

		<div class="form-group"><label>Height</label><input class="txtbox form-control" type="text" id="height" name="height" required></div>

		<div class="form-group"><label>Color</label><input class="txtbox form-control" type="text" id="color" name="color" required></div>


		<button type="submit" class="btn btn-default"> Add </button>
		<button type="reset" class="btn btn-default" value="Reset"> Clear </button>
	</form>
</div>

		<?php




		?>

</div>


<?php require "footer.php" ?>