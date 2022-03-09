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
class Model
{
    /** @var  Db conn */
    protected $conn;
    protected $tableName;
    protected $entityClass;

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
        return $this->conn->fetchOne("select * from {$this->tableName} where status=1 and id=:id", ['id' => $id],
            $this->entityClass
        );
    }

    public function getAll()
    {
        return $this->conn->fetchAll("select * from {$this->tableName} where status=1",
            $this->entityClass
        );
    }

    public function create()
    {

    }

    public function delete()
    {

    }




}