<h1 class="text-center">Add New Post</h1>
<form role="form" action="index.php?page=Posts&action=add" method="post">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
    </div>

    <div class="form-group">
        <label for="body">Post Text</label>
        <textarea class="form-control" id='body' rows="10" name="body" placeholder="Enter Text" required></textarea>
    </div>

    <input type="hidden" name="add" value='1' />


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
