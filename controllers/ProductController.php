<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 07.03.2022
 * Time: 10:03
 */

namespace app\controllers;

use app\base\App;
use app\models\Product;


/**
 * Главная страница
 * вывод товаров, карточка товара
 *
 * Class ProductController
 * @package app\controllers
 */
final class ProductController extends Controller
{
    public function actionIndex()
    {
        $products = $this->getModel()->getAll();
        App::call()->shop->setBasket();
        foreach ($products as $product) {
            $images = $this->getModel()->getImg($product->id);
            $img[$product->id] = (!empty($images[0]->small)) ? $images[0]->small : false;
        }
        echo $this->render("{$this->controllerName}/$this->actionName", [
            'products' => $products,
            'img' => $img
        ]);
    }

    public function actionView()
    {
        $id = App::call()->request->getParams();
        if (!$product = $this->getModel()->getOne($id)) {
            throw new \Exception("404");
        }
        $images = $this->getModel()->getImg($id);
        App::call()->shop->setBasket();
        echo $this->render("{$this->controllerName}/$this->actionName", [
            'product' => $product,
            'images' => $images
        ]);
    }

    /**
     * @return Product
     */
    private function getModel()
    {
        return App::call()->product;
    }
}