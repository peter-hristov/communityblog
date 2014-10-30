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

    <link rel="stylesheet" type="text/css" href="./resources/css/main.css">

    <link rel="stylesheet" type="text/css" href="./vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./vendor/twbs/bootstrap/dist/css/bootstrap-theme.css">
</head>

<body>
    <div class="page-wrap">
        <header class="header container">
            <?php require './views/Layout/header.php'; ?>
        </header>
        <hr>
        <div class="navigation container">
            <?php require './views/Layout/navbar.php'; ?>
        </div>
        <div id="main" class="content container clear-top   ">
            <?php (new $router->controller())->{$router->action}($_GET); ?>
        </div>
    </div>

    <footer class="container site-footer text-center">
        <?php require './views/Layout/footer.php'; ?>
    </footer>

</body>

</html>
