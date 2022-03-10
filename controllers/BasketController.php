<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 10:39
 */

namespace app\controllers;

use app\base\App;
use app\interfaces\IRenderer;
use app\models\Basket;


/**
 * Полная корзина, Заказ товаров
 * Вывод корзины на экран, пересчет количества, удаление товаров, очистка корзины
 * Подтверждение заказа
 *
 * Class BasketController
 * @package app\controllers
 */
class BasketController extends Controller
{
    private $fullBasket;
    private $data;
    private $products;

    /**
     * BasketController constructor.
     * @param null $renderer
     */
    public function __construct(IRenderer $renderer = null)
    {
        $this->renderer = $renderer;
        $this->fullBasket = $this->getModel()->getBasket($this->getIdBasket());
        $this->prepareBasket();
    }

    public function actionFull()
    {
        $priceAll = $amountAll = 0;
        foreach ($this->fullBasket as $item) {
            $this->products[$item->id_product] = [
                'id' => $item->id_product,
                'name' => $item->name_product,
                'price' => $item->price,
                'count' => $item->amount
            ];

            $amountAll += $item->amount;
            $priceAll += $item->price * $item->amount;
        }

        $this->data = [
            'countAll' => $amountAll,
            'price' => $priceAll
        ];

        echo $this->render("{$this->controllerName}/$this->actionName", [
            'products' => $this->products,
            'data' => $this->data
        ]);

    }

    public function actionOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->getModel()->updateOrderByBasket($this->getIdBasket(), $_POST['export'], $_POST['payment'])) {
                $date = new \DateTime('-30 days');
                $this->getModel()->clearDays($date->format('Y-m-d'));
                $message = true;
            }
        }
        echo $this->render("{$this->controllerName}/$this->actionName", [
            'message' => $message
        ]);
    }

    public function actionOrders()
    {
        $products = $this->getModel()->getBasket($this->getIdBasket(), 1);
        if (empty($products)) {
            $products = false;
        }
        echo $this->render("{$this->controllerName}/$this->actionName", [
            'products' => $products
        ]);
    }

    private function prepareBasket()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['clear']) {
                $this->getModel()->clear('id_basket', $this->getIdBasket());
                $this->redirect('./');
            } elseif ($_POST['submit']) {
                if ($_POST['delete']) {

                    foreach ($_POST['delete'] as $item) {
                        $this->getModel()->deleteProductByBasket($this->getIdBasket(), $item);
                    }

                    if (empty($this->getModel()->getBasket($this->getIdBasket()))) {
                        $this->redirect('./');
                    } else {
                        $this->redirect("./basket/full/");
                    }
                }

                if ($_POST['count']) {
                    foreach ($_POST['count'] as $key => $value) {
                        $this->getModel()->updateProductByBasket($this->getIdBasket(), $key, $value);
                    }

                    $this->fullBasket = $this->getModel()->getBasket($this->getIdBasket());
                }
            }
        }
    }

    private function getModel()
    {
        return new Basket();
    }

    private function getIdBasket()
    {
        return App::call()->shop->idBasket;
    }
}