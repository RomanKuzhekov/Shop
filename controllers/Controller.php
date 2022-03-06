<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 21:59
 */

namespace app\controllers;

use app\base\App;
use app\traits\TController;

/**
 * Основной контроллер
 * Запуск FrontControllerа c обработкой request запроса в браузере
 * Рендеринг шаблона, вывод на экран
 *
 *
 * Class Controller
 * @package app\controllers
 */
class Controller
{
    protected $controllerName;
    protected $actionName;


    use TController;


    public function runAction($controller = null, $action = null)
    {
        $this->controllerName = $controller;
        $this->actionName = $action ?: App::call()->config['defaultAction'];  //формируем имя actiona и запускаем как метод вызываемого класса
        $action = "action" . ucfirst($this->actionName);
        $this->$action();

    }

    protected function redirect($url)
    {
        header("Location: /$url");
    }

}