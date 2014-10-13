<ul class="nav navbar-nav navbar-default navbar-left clearfix">
    <li><a href="index.php?page=Posts">Posts</a></li>
    <li><a href="index.php?page=Types">Search</a></li>
    <li><a href="index.php?page=Orders">About Us</a></li>
</ul>
<ul class="nav navbar-nav navbar-default navbar-right">
    <?php if (Utils::isUserLogged()) : ; ?>
        <li><a ><?php echo 'Hello, '.$_SESSION['Auth']['email'].' !';?></a></li>
        <li><a href="index.php?page=Users&action=Logout">Logout</a></li>
    <?php else : ; ?>
        <li><a href="index.php?page=Users&action=Add">Register</a></li>
        <li><a href="index.php?page=Users&action=Login">Login</a></li>
    <?php endif; ?>
</ul>
