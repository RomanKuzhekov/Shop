<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 20:31
 */

namespace app\base;

include "../vendor/autoload.php";
include "../traits/Singleton.php";

use app\controllers\Controller;
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
 * @property Controller main
 *
 */

class App
{
    use Singleton;

    public $config;
    private $items = [];
    private $components;

    public function call()
    {
        return static::getInstance();
    }

    public function run()
    {
        $this->config = include "../config/config.php";
        $this->main->runAction();  //Запускаем FrontController
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
        if (!isset($this->items[$key])) {
            $this->items[$key] = $this->createComponent($key);
        }
        return $this->items[$key];
    }

    /**
     * @param string $name
     * @return object
     * @throws \Exception
     */
    private function createComponent(string $name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $className = $params['class'];
            var_dump($className);

            if (class_exists($className)) {  //реализуем подгрузку компонента для создания экзмепляра и загрузки свойств в конструктор(например для класса Db)
                unset($params['class']);
                $reflection = new \ReflectionClass($className);
                return $this->components = $reflection->newInstanceArgs($params);
            }
            throw new \Exception("Класс $className не был найден.");
        }
        throw new \Exception("Компонент $name не был найден в конфиге");
    }





}