<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 21:59
 */

namespace app\controllers;

use app\base\App;
use app\interfaces\IRenderer;
use app\services\Renderer;
use app\traits\TController;

/**
 * Основной контроллер
 * Запуск FrontControllerа c обработкой request запроса в браузере
 * Рендеринг шаблона, вывод на экран
 *
 *
 * Class Controller
 * @package app\controllers
 * @property string controllerName
 * @property string actionName
 */
class Controller
{
    protected $controllerName;
    protected $actionName;

    /** @var Renderer null  */
    public $renderer = null;

    use TController;

    public function __construct(IRenderer $renderer = null)
    {
        $this->renderer = $renderer;
    }

    public function runAction($controller = null, $action = null)
    {
        $this->controllerName = $controller;
        $this->actionName = $action ?: App::call()->config['defaultAction'];  //формируем имя actiona и запускаем как метод вызываемого класса
        $action = "action" . ucfirst($this->actionName);
        $this->$action();
    }

    public function render($template, $params = [])
    {
        if (App::call()->config['useLayout']) {
            $categories = App::call()->category->getAll();
            $mBasket = App::call()->shop->miniBasket();
            return $this->renderTemplate("layouts/" . App::call()->config['layout'],
                [
                    'content' => $this->renderTemplate($template, $params),
                    'categories' => $categories,
                    'mBasket' => $mBasket
                ]
            );
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    private function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    protected function redirect($url)
    {
        header("Location: /$url");
    }

    public function getDate()
    {
        return date('Y-m-d H-i-s');
    }
}