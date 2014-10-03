<?php
	require 'init.php';

	require __DIR__.'/views/Layout/header.php';

	require __DIR__."/controllers/{$router['controller']}.php";

	(new $router['controller']())->$router['action']($_GET);

	require __DIR__.'/views/Layout/footer.php';
?>
