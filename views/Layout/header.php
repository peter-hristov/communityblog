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
        <div>
            <div class="navigation container">
                <ul class="nav navbar-nav navbar-default navbar-left clearfix">
                    <li><a href="index.php?page=Posts">Posts</a></li>
                    <li><a href="index.php?page=Types">Search</a></li>
                    <li><a href="index.php?page=Orders">About Us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-default navbar-right">
                    <?php if (isUserLogged()) : ; ?>
                        <li><a ><?php echo 'Hello, '.$_SESSION['Auth']['email'].' !';?></a></li>
                        <li><a href="index.php?page=Users&action=logout">Logout</a></li>
                    <?php else : ; ?>
                        <li><a href="index.php?page=Users&action=add">Register</a></li>
                        <li><a href="index.php?page=Users&action=login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="content container">
