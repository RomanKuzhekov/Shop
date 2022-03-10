<? if (!$message): ?>
    <h1>Подтверждение заказа</h1>
    <p>Выберите способ получения товаров:</p>
    <form method="post">
        <p><label><input type="radio" checked name="export" value="Самовывоз" /> Самовывоз</label></p>
        <p><label><input type="radio" name="export" value="Доставка курьером" /> Доставка курьером</label></p>
        <p>Оплата товаров:</p>
        <p><label><input type="radio" checked name="payment" value="Наличные" /> Наличные</label></p>
        <input type="submit" value="Заказать">
    </form>
<? else: ?>
    <p>Спасибо за ваш заказ! С вами свяжутся в ближайшее время.</p>
<? endif;?>




