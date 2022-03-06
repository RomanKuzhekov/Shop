<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 06.03.2022
 * Time: 21:49
 */

namespace app\traits;


trait Singleton
{
    private static $instance = null;

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    private static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}