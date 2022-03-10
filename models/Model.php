<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 09.03.2022
 * Time: 22:52
 */

namespace app\models;

use app\base\App;
use app\services\Db;


/**
 * Абстрактная модель для выборки записей из БД
 *
 * Class Model
 * @package app\models
 */
abstract class Model
{
    /** @var  Db conn */
    protected $conn;
    protected $tableName;
    protected $entityClass;
    protected $attributes = [];

    public function __construct()
    {
        $this->conn = App::call()->db;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOne(int $id)
    {
        return $this->conn->fetchOne("SELECT * FROM {$this->tableName} where status = 1 and id = :id", ['id' => $id],
            $this->entityClass
        );
    }

    public function getAll()
    {
        return $this->conn->fetchAll("SELECT * FROM {$this->tableName} where status = 1",
            $this->entityClass
        );
    }

    public function create(array $data)
    {
        $dataString = $this->prepareAttributes($data);
        $columns = implode(', ', array_keys($this->attributes));
        if (!empty($this->attributes)) {
            return $this->conn->execute("INSERT INTO {$this->tableName} ({$columns}) VALUES ({$dataString})");
        }
    }

    public function prepareAttributes(array $data)
    {
        $dataString = '';
        foreach ($data as $key => $val) {
            if (in_array($key, static::$fields)) {
                $dataString .= ",'$val'";
                $this->attributes[$key] = $val;
            }
        }
        return substr($dataString, 1);
    }

    public function delete($nameColumn, $valueColumn)
    {
        return $this->conn->execute("DELETE FROM {$this->tableName} WHERE $nameColumn = $valueColumn");
    }
}