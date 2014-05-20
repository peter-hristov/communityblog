
<a href="<?php echo 'index.php?page=Posts&action=add'?>" class="btn btn-success">New Post</a>


<table class="table table-hover table-striped">
    <?php foreach ($data['Posts'] as $x) : ; ?>


    <tr>
        <td><?php echo $x['title']; ?></td>
        <td><?php echo $x['body']; ?></td>
        <td><?php echo $x['created']; ?></td>
        <td>
            <form role="form" action="index.php?page=Posts&action=delete" method="post">
                <input type="hidden" name="id" value=<?php echo $x['id'];?> />
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <i class="icon-remove"></i>
        </td>
    </tr>

    <?php endforeach; ?>
</table>