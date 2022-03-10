<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 9:46
 */

namespace app\models;

use app\base\App;


/**
 * Корзина
 *
 * Class Basket
 * @package app\models
 * @property int id_basket
 * @property int id_product
 * @property string name_product
 * @property int price
 */
class Basket
{
    protected static $fields = [
        'id_basket',
        'id_product',
        'name_product',
        'price',
        'created_at'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'basket';
        $this->entityClass = Basket::class;
    }

    public function getBasket($idBasket, $flag = 0)
    {
        return $this->conn->fetchAll("SELECT * FROM {$this->tableName} WHERE id_basket = $idBasket AND status = $flag ORDER BY id_product",
            $this->entityClass
        );
    }

    public function getProductByBasket($idBasket, $idProduct)
    {
        return $this->conn->fetchAll("SELECT * FROM {$this->tableName} WHERE id_basket = $idBasket AND id_product = $idProduct AND status = 0",
            $this->entityClass
        );
    }

    public function clear($nameColumn, $valueColumn)
    {
        return $this->conn->execute("DELETE FROM {$this->tableName} WHERE $nameColumn = $valueColumn  AND status = 0");
    }

    public function clearDays($date)
    {
        return $this->conn->execute("DELETE FROM {$this->tableName} WHERE created_at < '$date'  AND status = 0");
    }

    public function deleteProductByBasket($idBasket, $idProduct)
    {
        return $this->conn->execute("DELETE FROM {$this->tableName} WHERE id_basket = $idBasket AND id_product = $idProduct AND status = 0");
    }

    public function updateProductByBasket($idBasket, $idProduct, $amountBasket, $flag = 0)
    {
        if ($flag == 1) {
            $amountBasket = "amount + $amountBasket";
        }
        return $this->conn->execute("UPDATE {$this->tableName} SET amount = $amountBasket WHERE id_basket = $idBasket AND id_product = $idProduct AND status = 0");
    }

    public function updateOrderByBasket($idBasket, $delivery, $payment)
    {
        return $this->conn->execute("UPDATE {$this->tableName} SET status = 1, delivery = '$delivery', payment = '$payment' WHERE id_basket = $idBasket AND status = 0");
    }
}