<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 10:38
 */

namespace app\controllers;


use app\base\App;
use app\models\Category;


/**
 * Категории
 * Вывод товаров в категории
 * Возможность добавлять товар в корзину
 *
 * Class CategoryController
 * @package app\controllers
 */
final class CategoryController extends Controller
{
    public function actionView()
    {
        $idCategory = App::call()->request->getParams();
        $category = App::call()->category->getOne($idCategory);
        $products = $this->getModel()->getProductsByCategory($idCategory);
        $img = [];
        foreach ($products as $product) {
            $images = App::call()->product->getImg($product->id);
            $img[$product->id] = !empty($images[0]->small) ? $images[0]->small : false;
        }
        App::call()->shop->setBasket();
        echo $this->render(
            "{$this->controllerName}/{$this->actionName}",
            [
                'products' => $products,
                'img' => $img,
                'category' => $category,
            ]
        );
    }

    /**
     * @return Category mixed
     */
    private function getModel()
    {
        return App::call()->category;
    }
}