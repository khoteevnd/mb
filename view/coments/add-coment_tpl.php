<h3>Добавить коментарий:</h3>
<form class="well" action="?action=do-new-coment" method="post">
    <input name="post_id" type="hidden" value="<?=$records['post_id']; ?>">
    <?php if (isset($records['coment_id'])) {
    ?>
        <input name="coment_id" type="hidden" value="<?=$records['coment_id']; ?>">
    <?php 
} ?>
    <?php if ($_SESSION['loging'] == 'loging') {
    ?>
        <input name="author_id" type="hidden" value="<?=$_SESSION['author_id']?>">
    <?php 
}?>
    <textarea name="text" placeholder="Введите текст коментария"></textarea>
    <div>
        <button type="submit" class="btn-success">Дообавить коментарий</button>
    </div>
</form>