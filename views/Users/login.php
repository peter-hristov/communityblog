<h1 class="text-center">LOGIN</h1>

<h3> Log in with Facebook </h3>
<?php
    echo '<a href="'.\core\wrapper\FacebookWrapper::getLoginUrl().'"> Login With FB </a>';
?>


<h3> Log in with a communityblog account</h3>

<form role="form" action="index.php?page=Users&action=login " method="post">

    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
    </div>

    <div class="form-group">
        <label for="body">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>
