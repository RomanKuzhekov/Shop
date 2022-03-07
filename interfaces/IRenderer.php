<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 07.03.2022
 * Time: 9:50
 */

namespace app\interfaces;


interface IRenderer
{
    public function render($template, $params);
}