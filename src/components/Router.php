<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 15:27
 */

namespace Blade;

class Router
{
    public static function runImplicit()
    {
        $uri = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
        $uri = explode('/', $uri[0]);
        $controller = $uri[0] ?: 'index';
        $action = $uri[1] ?: 'index';
        $params = array_slice($uri, 2);
        return Blade::$router = [$controller, $action, $params];
    }

}
