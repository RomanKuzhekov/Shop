<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 10:39
 */

namespace app\controllers;


/**
 * Контакты
 *
 * Class ContactController
 * @package app\controllers
 */
class ContactController extends Controller
{
    public function actionIndex()
    {
        echo $this->render("{$this->controllerName}/{$this->actionName}");
    }
}