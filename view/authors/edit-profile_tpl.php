<div class="edit-profile">
    <h3>Редактирование профиля:</h3>
    <form class="" method="post" action="?action=apply-edit-profile" enctype="multipart/form-data">
        <label><b>Аватар: </b></label>
        <div class="logo">
            <img src="<?php echo $logo;?>" class="img-thumbnail" width="128" height="128">
        </div>
        <input type="file" name="logo">
        <label><b>Имя: </b></label>
        <input name="name" type="text" value="<?php echo $name;?>">
        <label><b>Текущий пароль: </b></label>
        <input name="pass_old" type="password" value="">
        <label><b>Новый пароль: </b></label>
        <input name="pass_new" type="password" value="">
        <label><b>Повторите новый пароль: </b></label>
        <input name="pass_new_conf" type="password" value="">
        <div>
            <button class="btn" type="submit">Изменить профиль!</button>
        </div>
    </form>
</div>