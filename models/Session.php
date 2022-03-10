<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 9:47
 */

namespace app\models;


/**
 * Авторизация(проверка) пользователей
 *
 * Class Session
 * @package app\models
 */
class Session extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'sessions';
        $this->entityClass = Session::class;
    }

    public function clearSession()
    {
        return $this->conn->execute(
            sprintf("DELETE FROM {$this->tableName} where last_update < %s", date('Y-m-d H:i:s', time() - 60 * 20))
        );
    }

    public function createNew($userId, $sid, $timeLast)
    {
        return $this->conn->execute(
            "INSERT INTO {$this->tableName} (user_id, sid, last_update) VALUES (?,?,?)",
            [$userId, $sid, $timeLast]
        );
    }

    public function updateLastTime($sid, $time = null)
    {
        if (is_null($time)) {
            $time = date('Y-m-d H:i:s');
        }
        return $this->conn->execute(
            "UPDATE {$this->tableName} SET last_update = '{$time}' WHERE sid = '{$sid}'");
    }

    public function getUidBySid($sid)
    {
        return $this->conn->fetchOne(
            "SELECT user_id FROM {$this->tableName} WHERE sid = ?", [$sid], $this->entityClass
        );
    }
}