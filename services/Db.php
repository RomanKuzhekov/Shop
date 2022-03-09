<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 09.03.2022
 * Time: 22:01
 */

namespace app\services;


/**
 * Класс для работы с БД
 * Подключение к БД - getConnection
 * Запрос на выполнение - execute
 * Одиночный выбор записи - fetchOne
 * Выбираем все записи - fetchAll
 *
 * Class Db
 * @package app\services
 */
class Db
{
    private $conn = null;
    private $config;

    public function __construct($driver, $host, $login, $password, $database, $charset)
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection()
    {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsn(),
                $this->config['login'],
                $this->config['password']
            );
        }

        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->conn;
    }

    private function query($sql, $params = null)
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function execute($sql, $params = null)
    {
        $this->query($sql, $params);
        return true;
    }

    public function fetchOne($sql, $params = [], $class)
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetch();
    }

    public function fetchAll($sql, $class)
    {
        $smtp = $this->query($sql);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetchAll();
    }

    private function prepareDsn()
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }
}