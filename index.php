<?php require 'init.php'; ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <title>Community Blog</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <script src="./vendor/yiisoft/jquery/jquery.js"></script>
    <script src="./vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" href="./vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./vendor/twbs/bootstrap/dist/css/bootstrap-theme.css">
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <?php require './views/Layout/header.php'; ?>
        </div>
        <div class="navigation container">
            <?php require './views/Layout/navbar.php'; ?>
        </div>

        <div class="content container">
            <?php require './controllers/'.$router->controller.'.php'; // #magic
            (new $router->controller())->{$router->action}($_GET); ?>
        </div>
        <div class="footer container">
            <?php require './views/Layout/footer.php'; ?>
        </div>
    </div>
</body>

</html>
