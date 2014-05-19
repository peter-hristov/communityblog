<?php
	require 'init.php';

	require __DIR__.'/views/header.php';

	require __DIR__."/Controllers/{$router['controller']}.php";
	(new $router['controller']())->$router['action']($_GET);

	require __DIR__.'/views/footer.php';
?>
