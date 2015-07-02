<h3>Добавить Пост:</h3>
<form class="well" action="?action=do-new-post" method="post">
    <input name="author_id" hidden="hidden" value="<?php echo $_SESSION["author_id"];?>">
    <label>Тема:</label>
    <input name="title" type="text" placeholder="Введите тему поста">
    <label>Текст:</label>
    <textarea name="text" placeholder="Введите текст поста"></textarea>
    <div>
        <button type="submit" class="btn">Добавить пост</button>
    </div>
</form>
