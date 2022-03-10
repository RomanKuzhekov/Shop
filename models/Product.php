<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 09.03.2022
 * Time: 23:17
 */

namespace app\models;


/**
 * Товары
 *
 * Class Product
 * @package app\models
 */
class Product extends Model
{
    private $tableNameImg;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "products";
        $this->tableNameImg = "img_products";
        $this->entityClass = Product::class;
    }

    public function getImg(int $idProduct)
    {
        return $this->conn->fetchAll("SELECT * FROM {$this->tableNameImg} WHERE id_product = $idProduct",
            $this->entityClass
        );
    }
}