<h1>Мои заказы:</h1>
<? if (!$products): ?>
    <p>У вас нет заказов!</p>
<? else: ?>
    <table class="fbasket" border="1" cellspacing="0">
        <tr>
            <td>Наименование</td>
            <td>Количество</td>
            <td>Цена за 1 товар</td>
            <td>Статус</td>
            <td>Доставка</td>
            <td>Оплата</td>
            <td>Дата создания</td>
        </tr>
        <? foreach ($products as $product): ?>
            <tr>
                <td><?=$product->name_product?></td>
                <td><?=$product->amount?></td>
                <td><?=$product->price?></td>
                <?
                switch($product->state){
                    case 0:
                        $state = 'В обработке';
                        break;
                    case 1:
                        $state = 'Выполнено';
                        break;
                }
                ?>
                <td><?=$state?></td>
                <td><?=$product->delivery?></td>
                <td><?=$product->payment?></td>
                <td><?=$product->created_at?></td>
            </tr>
        <? endforeach; ?>
    </table>
    <p>Общая сумма: <?= $product->amount * $product->price?> рублей</p>
<? endif; ?>

