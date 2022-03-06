<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 21:59
 */

namespace app\controllers;


use app\base\App;

/**
 * Роутинг приложения
 * Получаем имя контроллера, action
 * Создаем экзмепляр класса на основе полученного имени контроллера и запускам runAction
 * Проверка авторизованного пользователя на сайте
 *
 *
 *
 * Class FrontController
 * @package app\controllers
 * @property string Controller
 *
 */
class FrontController extends Controller
{

    private $controller;

    public function actionIndex()
    {
        $request = App::call()->request;
        $this->controllerName = $request->getControllerName() ?: App::call()->config['defaultController'];
        $this->actionName = $request->getActionName();
        $this->controller = App::call()->config['controller_namespace'] . ucfirst($this->controllerName) . "Controller";

        $this->checkLogin();

        var_dump("render");

        try {

        } catch (\Exception $e) {

        }


    }

    private function checkLogin()
    {

    }


}