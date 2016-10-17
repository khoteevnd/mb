<div class="message">
    <p><?php echo $records['message']; ?></p>
</div>
<hr>
<?php if (isset($_SESSION['loging']) and $_SESSION['loging'] == 'loging'):?>
    <div class="add-post">
        <a class="btn btn-primary" href="?action=add-post" role="button">Add post</a>
    </div>
<?php endif?>
