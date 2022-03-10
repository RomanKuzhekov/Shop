<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 9:47
 */

namespace app\models;


class User extends Model
{
    protected static $fields = [
        'name',
        'login',
        'password',
        'created_at',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
        $this->entityClass = User::class;
    }

    public function getByLoginPass($login, $pass)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE login = :login AND password = :password";
        return $this->conn->fetchOne($sql,
            [
                ":login" => $login,
                ":password" => md5($pass)
            ],
            $this->entityClass
        );
    }

    public function getCurrent()
    {
        if ($userId = $this->getUserId()) {
            return $this->getById($userId->user_id);
        }
        return null;
    }

    public function getUserId()
    {

    }

    public function getById(int $id)
    {
        return $this->conn->fetchOne("SELECT * FROM {$this->tableName} WHERE id = ?", [$id],
            $this->entityClass
        );
    }


}