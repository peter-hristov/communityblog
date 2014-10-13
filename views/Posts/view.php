<p><?php echo $data['Posts']['title'] ?></p>
<p><?php echo $data['Posts']['body'] ?></p>

<p>Comments</p>

<?php if(Utils::isUserLogged()) : ;?>
    <a href=<?php echo 'index.php?page=Comments&action=add&post_id='.$data['Posts']['id']?> class="btn btn-success">Add Comment</a>
<?php endif; ?>

<table class="table table-hover table-striped">
    <?php foreach ($data['Comments'] as $x) : ; ?>
    <tr>
        <td><?php echo $x['text']; ?></td>

        <td><?php echo $x['email']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>