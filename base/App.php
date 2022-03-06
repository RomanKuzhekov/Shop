<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 20:31
 */

namespace app\base;

/**
 * Главный класс для входа в приложение
 * Синглтон для одиночного подключения класса
 * Автозагрузчик composera для подключения файлов
 * Магический метод get для подключения компонентов прописанные в конфиге
 * Запуск FrontControllera для обработки запроса переданного из браузера (/controller/action/id)
 *
 *
 * Class App
 * @package app\base
 *
 */

class App
{

    private static $instance = null;

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    private static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function call()
    {
        return static::getInstance();
    }

    public function run()
    {

    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param string $key
     * @return mixed
     */
    private function get(string $key)
    {

    }

    /**
     * @param string $name
     * @return object
     * @throws \Exception
     */
    private function createComponent(string $name)
    {

    }





}