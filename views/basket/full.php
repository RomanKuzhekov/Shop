<h1>Корзина товаров</h1>
<form method="post">
    <table class="fbasket" border="1" cellspacing="0">
        <tr>
            <th>Номер товара</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Удалить</th>
        </tr>
        <? if(!empty($products)): ?>
            <? foreach ($products as $product): ?>
                <tr>
                    <td><?=$product['id']?></td>
                    <td><?=$product['name']?></td>
                    <td><?=$product['price']?></td>
                    <td><input style="text-align: center" type="text" name="count[<?=$product['id']?>]" size="10" value="<?=$product['count']?>"></td>
                    <td><input type="checkbox" value="<?=$product['id']?>" name="delete[]"></td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
    <p>
        <input type="submit" name="clear" value="Очистить корзину">
        <input type="submit" name="submit" value="Пересчитать">
    </p>
</form>
<p>Общая цена: <?=$data['price']?> руб.  Количество товаров: <?=$data['countAll']?></p>
<p class="add-to-basket"><a href="/basket/order/" title="Оформить Заказ">Оформить Заказ</a></p>

