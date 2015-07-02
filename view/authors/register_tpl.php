<form class="form-signin" method="post" action="<?php echo '?action=new-register' ?>">
    <h2 class="form-signin-heading">Регистрация</h2>
    <label for="inputEmail" class="sr-only">Логин:</label>
    <input name="login" type="text" id="inputEmail" class="form-control" placeholder="Адрес эл. почты" required autofocus>
    <label for="inputPassword" class="sr-only">Пароль:</label>
    <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
    <label for="inputPassword" class="sr-only">Повторите пароль:</label>
    <input name="pass_confirm" type="password" id="inputPassword" class="form-control" placeholder="Повторите пароль" required>
    <div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегестрироваться</button>
    </div>
</form>
<a href="<?php echo "?action=login"?>">Войти</a>