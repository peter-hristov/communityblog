<?php  require 'init.php'; ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Community Blog</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <script src="./resources/js/jquery-1.11.1.js"></script>
    <script src="./resources/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./resources/css/bootstrap/bootstrap.css">

    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
</head>

<body>
    <div class="wrapper">

        <?php  require __DIR__.'/views/Layout/header.php'; ?>

        <div class="navigation container">
            <?php  require __DIR__.'/views/Layout/navbar.php'; ?>
        </div>

        <div class="content container">
            <?php
                require __DIR__."/controllers/{$router['controller']}.php";

                $class = 'controller\\'.$router['controller'];

                (new $class())->$router['action']($_GET);
            ?>
        </div>

        <div class="footer container">
            <?php require __DIR__.'/views/Layout/footer.php'; ?>
        </div>

    </div>
</body>

</html>
