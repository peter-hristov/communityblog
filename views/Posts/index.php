<h1 class="text-center">Index</h1>

<?php if(\Utils::isUserLogged()) : ;?>
<a href="<?php echo 'index.php?page=Posts&action=add'?>" class="btn btn-success">New Post</a>
<?php endif; ?>

<table class="table table-hover table-striped">
    <?php foreach ($data[ 'Posts'] as $x) : ; ?>
    <tr>
        <td>
            <a href=<?php echo 'index.php?page=Posts&action=view&id='.$x[ 'id']?> ><?php echo $x['title']; ?></a>
        </td>

        <td>
            <?php echo $x[ 'body']; ?>
        </td>

        <td>
            <?php echo $x[ 'created']; ?>
        </td>

        <?php if(\Utils::isUserLogged()) : ;?>
        <td>
            <a class="btn btn-primary" href=<?php echo 'index.php?page=Posts&action=edit&id='.$x[ 'id']?> >Edit</a>
        </td>
        <td>
            <form role="form" action="index.php?page=Posts&action=delete" method="post">
                <input type="hidden" name="id" value=<?php echo $x['id'];?> />
                <button onclick="return confirm('Delete This Post?')" type="submit" class="btn btn-danger">Delete</button>
            </form>
            <i class="icon-remove"></i>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
