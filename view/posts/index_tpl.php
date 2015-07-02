<div class="posts">
    <?php foreach($records as $row):?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                    <a href="?action=view-post&id=<?=$row['post_id']?>"><?=$row['title']?></a>
                    <?php if(isset($_SESSION["loging"]) and $_SESSION["loging"] == "loging"):?>
                        <?php if($_SESSION["author_id"] == $row['author_id']):?>
                            <div class="btn-group">
                                <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i><?php echo $_SESSION['login'];?></a>
                                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="i"></i> Make admin</a></li>
                                </ul>
                            </div>
                            <a href="?action=edit-post&id=<?=$row['post_id']?>">edit<i class="icon-edit"></i></a>
                            <a href="?action=dell-post&id=<?=$row['post_id']?>">dell<i class="icon-trash"></i></a>
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
                <div class="coments">
                    <i>
                        <a href="?action=view-coments"><?=$row['coments']?> coment(s)</a>
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
