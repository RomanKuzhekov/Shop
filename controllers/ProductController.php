<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 07.03.2022
 * Time: 10:03
 */

namespace app\controllers;


class ProductController extends Controller
{

    public function actionIndex()
    {
        var_dump(111);
    }

    public function actionView()
    {

        echo $this->render("{$this->controllerName}/{$this->actionName}", []);

    }

}