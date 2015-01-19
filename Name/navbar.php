<div class="container">
<ul class="nav navbar-nav">
	<li> <a href="./index.php"> Home </a></li>
	<li> <a href="./about.php"> About </a></li>
	<li> <a href="./list.php"> Cool </a></li>
	<li> <a href="./create.php"> Add New </a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
	<?php
		if (empty($_SESSION["Auth"])):;
		?>
			<li> <a href="./register.php"> Register </a></li>
			<li> <a href="./login.php"> Log in </a></li>
		
		<?php else:; ?>
	<li> <a href="#"> Now logged in as <?php echo $_SESSION["Auth"]["username"] ?></a> </li>
	<li> <a href="./logout.php"> Log out </a></li>
		<?php endif; ?>
	
	


</ul>
</div>
