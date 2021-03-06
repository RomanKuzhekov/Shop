<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.12.2017
 * Time: 20:06
 */

namespace app\controllers;

use app\base\App;
use app\models\User;
use app\services\Renderer;

/**
 * Роутинг приложения
 * Получаем имя контроллера, актион
 * создаем экзмепляр класса на основе полученного имени контроллера и запускам runAction
 * проверка авторизованного пользователя на сайте
 *
 * Class FrontController
 * @package app\controllers
 * @property string Controller
 */
class FrontController extends Controller
{
    private $controller;

    protected function actionIndex()
    {
        $request = App::call()->request;
        $this->controllerName = $request->getControllerName() ?: App::call()->config['defaultController'];
        $this->actionName = $request->getActionName();
        $this->controller = App::call()->config['controller_namespace'] . ucfirst($this->controllerName) . 'Controller';
        $this->checkLogin();
        /** @var  Controller $controller */
        $controller = new $this->controller(new Renderer());
        try {
            $controller->runAction($this->controllerName, $this->actionName);
        } catch (\Exception $e) {
            $this->redirect('./');
        }
    }

    private function checkLogin()
    {
        session_start();
        if ($this->controller != "\\" . AuthController::class) {
            $user = (new User())->getCurrent();
            if (!empty($_SESSION['sid']) && is_null($user)) {
                $this->redirect('auth/logout');
            }
        }
    }

}
