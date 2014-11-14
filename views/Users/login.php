<h1 class="text-center">LOGIN</h1>
<?php
    $redirect_url = 'http://localhost:8080/index.php?page=Users&action=blqLogin';
    echo '<a href="'.(new \Facebook\FacebookRedirectLoginHelper($redirect_url))->getLoginUrl().'"> Login With FB </a>';
?>

<form role="form" action="index.php?page=Users&action=login " method="post">

    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
    </div>

    <div class="form-group">
        <label for="body">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
    </div>

    <!--  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div> -->

    <!-- <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div> -->

    <button type="submit" class="btn btn-default">Submit</button>


</form>
