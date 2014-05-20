
<a href="<?php echo 'index.php?page=Posts&action=add'?>" class="btn btn-success">New Post</a>

<h3 class="text-center">Index</h3>
<table class="table table-hover table-striped">
    <?php foreach ($data['Posts'] as $x) : ; ?>
    <tr>

        <td>
            <a href=<?php echo 'index.php?page=Posts&action=view&id='.$x['id']?> ><?php echo $x['title']; ?></a>
        </td>

        <td><?php echo $x['body']; ?></td>

        <td><?php echo $x['created']; ?></td>

        <td>
            <a class="btn btn-primary" href=<?php echo 'index.php?page=Posts&action=edit&id='.$x['id']?> >Edit</a>
        </td>

        <td>
            <form role="form" action="index.php?page=Posts&action=delete" method="post">
                <input type="hidden" name="id" value=<?php echo $x['id'];?> />
                <button onclick="return confirm('Delete This Post?')"  type="submit" class="btn btn-danger">Delete</button>
            </form>
            <i class="icon-remove"></i>
        </td>
    </tr>

    <?php endforeach; ?>
</table>