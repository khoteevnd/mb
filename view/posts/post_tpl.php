<div class="post">
    <h3><?=$records_posts['title']?></h3>
    <div class="text">
        <?=$records_posts['text']?>
    </div>
    <div class="pubdate">
        <h6><i><?=$records_posts['pubdate']?></i></h6>
    </div>
    <div>
        <i>
            <img src="<?=$records_posts['logo']?>" width="20" height="20">
            <b>Автор: </b>
            <a href="?action=view-author-post&id=<?=$records_posts['author_id']?>"><?=$records_posts['name']?></a>
        </i>
    </div>
    <hr>
</div>
    <h3>Коментарии:</h3>
    <?php if(!empty($records_coments)):?>
    <?php foreach($records_coments as $records):?>
    <?php $a = 0;?>
        <div class="coment" id="levl<?=$records['levl']?>">
            <div class="coment-body" id="levl<?=$records['levl']?>"">
                <?php if(isset($records['user_id']) and (($records['user_id'] != 0) || !empty($records['user_id']))):?>
                    <div>user_id: <?=$records['user_id']?></div>
                <?php endif?>
                <?php if(isset($records['author_id']) and (($records['author_id'] != 0) || !empty($records['author_id']))):?>
                    <div>user_id: <?=$records['aythor_id']?></div>
                <?php endif?>
                <div class="text">
                    <?=$records['text']?>
                </div>
                <div class="pubdate">
                    <h6><i><?=$records['date']?></i></h6>
                </div>
            </div>
            <form class="coment-coment" action="?action=add-coment" method="post">
                <button type="submit" class="btn" value="add-coment">Add coment</button>
                <input name="parent" hidden="hidden" value="<?=$records['parent'];?>">
                <input name="post_id" hidden="hidden" value="<?=$records_posts['post_id'];?>">
                <input name="user_id" hidden="hidden" value="<?=$records['user_id'];?>">
            </form>
        </div>
    <?php endforeach?>
    <?php endif?>
    <form class="well" action="?action=add-coment" method="post">
        <input name="post_id" hidden="hidden" value="<?=$records_posts['post_id'];?>">
        <button type="submit" class="btn-success" value="">Добавить коментарий</button>
    </form>
