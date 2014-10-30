<div claa='row clearfix'>
    <ul class="nav navbar-nav navbar-default navbar-left">
        <li><a href="index.php?page=Posts">Posts</a>
        </li>
        <li><a href="index.php?page=Pages&action=construction">Search</a>
        </li>
        <li><a href="index.php?page=Pages&action=construction">About Us</a>
        </li>
        <li><a href="index.php?page=Tests&action=ajax">Ajax</a></li>
        <li><a href="index.php?page=Tests&action=jquery">jquery</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-default navbar-right">
        <?php if (Utils::isUserLogged()) : ; ?>
        <li>
            <a>
                <?php echo 'Hello, '.$_SESSION['Auth']['email']. ' !';?>

                <?php if ($_SESSION['Auth']['email_confirmed'] !=1 ) : ; ?>
                    <p>Please confirm your email.</p>
                <?php endif; ?>
            </a>
        </li>
        <li><a href="index.php?page=Users&action=logout">Logout</a>
        </li>
        <?php else : ; ?>
        <li><a href="index.php?page=Users&action=add">Register</a>
        </li>
        <li><a href="index.php?page=Users&action=login">Login</a>
        </li>
        <?php endif; ?>
    </ul>
</div>
