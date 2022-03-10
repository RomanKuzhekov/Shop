<? if(!$_SESSION['sid']): ?>
    <h2>Регистрация на сайте</h2>
    <?php if(!empty($message[0])){ ?>
        <u><?=$message[0]?></u>
    <?php } else { ?>
        <form method="post" class="reg">
            <p>Имя<span>*</span>: <input type="text" name="name" maxlength="30" placeholder="Введите имя" autofocus required></p>
            <p>Логин<span>*</span>: <input type="text" name="login" maxlength="30" placeholder="Введите Логин" required></p>
            <p>Пароль<span>*</span>: <input type="password" minlength="2" name="password" placeholder="Введите Пароль" required></p>
            <input type="submit" name="submit" value="Зарегистрироваться" ">
        </form>
    <?php } ?>
<? endif; ?>