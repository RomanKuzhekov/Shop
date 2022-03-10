<? if(!$_SESSION['sid']): ?>
    <h1>Вход на сайт</h1>
    <b><?= (!empty($message)) ? $message : false;?></b>
    <form method="post">
        <p>Логин: <input type="text" name="login" maxlength="30" placeholder="Введите Логин" autofocus required></p>
        <p>Пароль: <input type="password" minlength="2" name="password" placeholder="Введите Пароль" required></p>
        <input type="submit" name="enter" value="Войти" ">
    </form>
<? endif; ?>