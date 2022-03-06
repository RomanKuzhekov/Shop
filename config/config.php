<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 21:34
 */

return [
    'root_dir' => $_SERVER['DOCUMENT_ROOT']."/../",
    'controller_namespace' => 'app\controllers\\',
    'defaultController' => 'product',
    'defaultAction' => 'index',
    'useLayout' => true,
    'layout' => 'main',
    'components' => [
        'db' => [],
        'main' => [
            'class' => \app\controllers\FrontController::class
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'comment' => [],
        'product' => [],
        'user' => [],
        'category' => [],
        'shop' => [],
    ]
];




