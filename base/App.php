<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 20:31
 */

namespace app\base;

include "../traits/Singleton.php";

use app\traits\Singleton;

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

    use Singleton;

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