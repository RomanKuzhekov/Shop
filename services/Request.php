<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 23:00
 */

namespace app\services;

/**
 * Обработчик запросов из адресной строки браузера
 * Парсим адресную строку браузера и возвращаем имя:
 * контроллера, актион, параметры
 *
 *
 * Class Request
 * @package app\services
 * @property string requestString
 */
class Request
{

    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    private $patterns = [
        "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?(?P<params>.*)#ui"
    ];


    public function __construct()
    {
        $this->requestString = $_SERVER["REQUEST_URI"];
        $this->parseRequest();
    }

    private function parseRequest()
    {
        foreach ($this->patterns as $pattern) {
            if (preg_match_all($pattern, $this->requestString, $matches)) {
                $this->controllerName = $matches['controller'][0];
                $this->actionName = $matches['action'][0];
                $this->params = $matches['params'][0];
            }
        }
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }

}