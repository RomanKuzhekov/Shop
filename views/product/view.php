<div class="item-content">
    <? if(!$product){die("Ошибка 404");} ?>
    <h2><?=$product->name?></h2>
    <div class="images-item">
        <div class="img-big">
            <img src="<?=$images[0]->big?>">
        </div>
        <div class="small-img">
            <? foreach ($images as $img): ?>
                <img src="<?=$img->small?>">
            <? endforeach; ?>
        </div>
    </div>
    <div class="item_desc">
        <h3>Описание товара:</h3>
        <div class="short">
            <p><?=$product->description?></p>
        </div>
        <div class="o-pay">
            <p class="price"><?=$product->price?>р.</p>
            <form method="post">
                <input type="hidden" name="id" value="<?=$product->id?>">
                <input type="hidden" name="name" value="<?=$product->name?>">
                <input type="hidden" name="price" value="<?=$product->price?>">
                <input type="submit" class="add-basket" name="submit" value="Добавить в корзину">
            </form>
        </div>
    </div>
</div>
