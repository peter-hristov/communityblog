<h1 class="text-center">Add New Comment</h1>
<form role="form" action="index.php?page=Comments&action=add" method="post">


    <?php if(!Utils::isUserLogged()) : ; ?>
        <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
        </div>
    <?php endif; ?>

    <div class="form-group">
    <label for="text">Post Text</label>
    <textarea class="form-control" id='text' rows="10" name="text" placeholder="Enter Text" required></textarea>
    </div>

    <input type="hidden" name="post_id" value=<?php echo $_GET['post_id'];?> />


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