<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=".">Блог</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav nav-left">
                <?php if(isset($_SESSION["loging"]) and $_SESSION["loging"] == "loging"):?>
                    <li class="active"><a href=".">Главная</a></li>
                    <li><a href="?action=your-posts">Ваши публикации</a></li>
                    <li><a href="?action=profile">Профиль</a></li>
                <?php else:?>
                    <li><a href=".">Главная</a></li>
                    <li class=""><a href="?action=login">Войти</a></li>
                    <li class=""><a href="<?php echo "?action=register";?>">Регистрация</a></li>
                <?php endif?>
            </ul>
            <ul class="nav navbar-nav nav-right">
                <?php if(isset($_SESSION["loging"]) and $_SESSION["loging"] == "loging"):?>
                    <li><p class="navbar-text">Вы вошли как: <a href="?action=profile"><b><?php echo $_SESSION["name"];?></b></a></p></li>
                    <li><img class="logo-mini" src="<?php echo $_SESSION["logo"];?>" class="img-thumbnail" height="30" width="30"></li>
                    <li><p class="navbar-text"><a href="?action=logout">Выйти</a></p></li>
                <?php endif ?>
            </ul>

        </div>

    </div>
</div>