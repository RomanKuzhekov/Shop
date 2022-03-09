<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 20:14
 */

require_once "../base/App.php";

\app\base\App::call()->run();



$a = \app\base\App::call()->db;
var_dump($a);
//var_dump($a->getConnection());
var_dump($a->fetchAll("SELECT * from products", "Product"));