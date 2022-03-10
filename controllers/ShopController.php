<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 10:40
 */

namespace app\controllers;

use app\models\Basket;


/**
 * Добавление товара в корзину
 * Привязка id корзины к пользователю на cookie
 * Вывод мини корзины
 *
 * Class ShopController
 * @package app\controllers
 */
class ShopController extends Controller
{
    public $idBasket;
    private $amount = 0;
    private $price = 0;
    private $products;

    public function __construct()
    {
        if (!isset($_COOKIE['idGuest'])) {
            setcookie("idGuest", rand(-1000000, -1000), time() + 3600 * 24 * 7);
        }
        $this->idBasket = (!empty($_SESSION['idUser'])) ? $_SESSION['idUser'] : $_COOKIE['idGuest'];
        $this->products = $this->getModel()->getBasket($this->idBasket);
    }

    public function setBasket()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['submit']) {
            if (empty($this->products)) {
                $this->setProducts();
            } else {
                if ($this->getModel()->getProductByBasket($this->idBasket, $_POST['id'])) {
                    $this->getModel()->updateProductByBasket($this->idBasket, $_POST['id'], 1, 1);
                } else {
                    $this->setProducts();
                }
            }
        }
    }

    public function miniBasket()
    {
        $mBasket = [
            'amount' => $this->prepareAmount(),
            'price' => $this->preparePrice()
        ];
        return $mBasket;
    }

    private function prepareAmount()
    {
        $amountAll = $this->getModel()->getBasket($this->idBasket);
        foreach ($amountAll as $item) {
            $this->amount += $item->amount;
        }
        return $this->amount;
    }

    private function preparePrice()
    {
        $priceAll = $this->getModel()->getBasket($this->idBasket);
        foreach ($priceAll as $item) {
            $this->price += $item->price * $item->amount;
        }
        return $this->price;
    }

    private function setProducts()
    {
        $this->getModel()->create(
            [
                'id_basket' => $this->idBasket,
                'id_product' => $_POST['id'],
                'name_product' => $_POST['name'],
                'price' => $_POST['price'],
                'created_at' => $this->getDate()
            ]
        );
    }

    public function getModel()
    {
        return new Basket();
    }
}