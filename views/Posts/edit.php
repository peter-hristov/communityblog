<h1 class="text-center">
    <?php echo 'Edit Post '.$data[ 'id']; ?>
</h1>
<form role="form" action="index.php?page=Posts&action=edit" method="post">


    <div class="form-group">
        <label for="title">Post Title</label>
        <textarea class="form-control" id='title' rows="1" name="title" required>
            <?php echo $data['title']; ?>
        </textarea>
    </div>

    <div class="form-group">
        <label for="body">Post Text</label>
        <textarea class="form-control" id='body' rows="10" name="body" required>
            <?php echo $data['body']; ?>
        </textarea>
    </div>

    <input type="hidden" name="id" value=<?php echo $data[ 'id'];?>/>
    <input type="hidden" name="edit" value='1' />

    <button type="submit" class="btn btn-default">Submit</button>


</form>
