<div class="posts">
    <?php foreach($records as $row):?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                    <a href="?action=view-post&id=<?=$row['post_id']?>"><?=$row['title']?></a>
                    <?php if(isset($_SESSION["loging"]) and $_SESSION["loging"] == "loging"):?>
                        <?php if($_SESSION["author_id"] == $row['author_id']):?>
                            <a href="?action=edit-post&id=<?=$row['post_id']?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a href="?action=dell-post&id=<?=$row['post_id']?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        <?php endif?>
                    <?php endif?>
                </h3>
            </div>
            <div class="panel-body">
                <div>
                    <?=$row['text']?>
                </div>
                <div><h6><i><?=$row['pubdate']?></i></h6></div>
                <div>
                    <i>
                        <img src="<?=$row['logo']?>" width="20" height="20">
                        <b>Автор: </b>
                        <a href="?action=view-author-posts&id=<?=$row['author_id']?>"><?=$row['name']?></a>
                    </i>
                </div>
                <div class="count-coments">
                    <i>
                        <a href="?action=view-coments"><span class="badge"><?=$row['coments']?></span> comment(s)</a>
                    </i>
                </div>
            </div>
        </div>

    <?php endforeach?>
</div>
<br>
<?php if(isset($_SESSION["loging"]) and $_SESSION["loging"] == "loging"):?>
    <div class="add-post">
        <a class="btn btn-primary" href="?action=add-post" role="button">Add post</a>
    </div>
<?php endif?>
