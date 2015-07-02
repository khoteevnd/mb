<div class="login">
    <form class="form-signin" method="post" action="<?php echo "?action=author"?>">
        <h2 class="form-signin-heading">Пожалуйста войдите</h2>
        <label for="inputEmail" class="sr-only">Адрес эл. почты</label>
        <input name="login" type="text" id="inputEmail" class="form-control" placeholder="Адрес эл. почты" required autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <div class="checkbox">
            <label><input type="checkbox" name="auth_type" value="remember-me"> запомнить меня</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
    <a href=<?php echo "?action=register";?>>Регистрация</a>
</div>