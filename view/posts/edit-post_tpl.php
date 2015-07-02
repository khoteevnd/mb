<h3>Редактирование Поста:</h3>
<form class="well" action="?action=apply-edit-post" method="post">
    <input name="post_id" hidden="hidden" value="<?=$post_id;?>">
    <input name="author_id" hidden="hidden" value="<?=$author_id;?>">
    <div class="posts">
        <div class="title">
            <label>Тема:</label>
            <input name="title" type="text" value="<?=$title;?>">
        </div>
        <div class="body-text">
            <label>Текст:</label>
            <textarea name="text"><?=$text;?></textarea>
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Применить изменения</button>
    </div>
</form>
