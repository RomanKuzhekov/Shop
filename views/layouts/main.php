<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Интернет-магазин ноутбуков</title>
    <link rel="stylesheet" href="/assets/css/styles.css" type="text/css" media="all"/>
</head>
<body>
<div id="container">
    <header>
        <div class="logotip">
            <a href='/'><img src="/assets/images/main/logotip.png" alt="Логотип сайта" title="Магазин ноутбуков"></a>
        </div>
    </header>
    <!--    --><?//
    //    if(isset($_SESSION[basket])) {
    //        echo "<h3 class=\"basket\">Корзина: <span class=\"basket-items\"><a href='basket.php'><u>Просмотреть товары</u></a></span></h3>";
    //    }else{
    //        echo "<h3 class=\"basket\">Корзина: <span class=\"basket-items\">Корзина пуста</span></h3>";
    //    }
    //    ?>
    <div class="leftblock">
        <nav>
            <div class="menu">
                <ul>
                    <li><a href="/" class="active">Главная</a></li>
                    <ul>
                        <? foreach ($categories as $category): ?>
                            <li><a href="/category/view/<?=$category->id?>"><?=$category->name?></a></li>
                        <? endforeach; ?>
                    </ul>
                    <li><a href="/guestbook">Отзывы</a></li>
                    <li><a href="/contact">Контакты</a></li>
                    <?php if(!empty($_SESSION['sid'])): ?>
                        <li>Личный кабинет:</li>
                        <li><?=ucfirst($_SESSION['name'])?> (<?=$_SESSION['login']?>) </li>
                        <li><a href="/basket/orders/">Мои Заказы</a></li>
                        <li><a href='/auth/logout'><u>Выйти</u> </a></li>
                    <?php else: ?>
                        <li><a href='/auth/login'><u>Войти</u></a></li>
                        <li><a href='/auth/signup'><u>Регистрация</u></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>

    <div class="content">
        <div class="basket">
            <b>Корзина:</b>
            <? /** @var \app\controllers\ShopController $mBasket */ ?>
            <? if(empty($mBasket['amount'])):?>
                пусто
            <? else: ?>
                <a href="/basket/full"><u>товары:<?=$mBasket['amount']?></u></a> (<?=$mBasket['price']?> руб.)
            <? endif; ?>
        </div>
        <h1>Интернет-магазин ноутбуков</h1>
        <hr>
        <?=$content?>
    </div>
    <footer>
        <p>&copy; Интернет-магазин написан в ознакомительных целях.</p>
    </footer>
</div>
</body>
</html>