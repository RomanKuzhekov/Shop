<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 23:55
 */

namespace app\services;

use app\base\App;
use app\interfaces\IRenderer;


/**
 * Рендеринг шаблона
 *
 * Class Renderer
 * @package app\services
 */
class Renderer implements IRenderer
{
    public function render($template, $params)
    {
        ob_start();
        $templatePath = App::call()->config['root_dir'] . "/views/{$template}.php";
        extract($params);
        include $templatePath;
        return ob_get_clean();
    }
}