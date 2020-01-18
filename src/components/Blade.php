<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 16:05
 */

namespace Blade;

/**
 * Class App
 *
 * @package Blade
 * @property $user
 */
class Blade extends Container
{
    /**
     * @var Blade $app
     */
    public static $app;

    /**
     * @var array $config
     */
    public static $config;

    /**
     * @var array $request
     */
    public static $request;

    /**
     * @var array $response
     */
    public static $response;

    /**
     * @var array $middleware
     */
    public static $middleware;

    /**
     * @var array $router
     */
    public static $router;

    /**
     * @return \Blade\Blade
     */
    public static function init()
    {
        ExceptionHandler::boot();
        return self::$app = new self();
    }

    public static function runApplication()
    {
        $next = function () {
            list($controller, $action, $params) = Blade::$router;
            $controllerName = '';
            foreach (explode("-", $controller) as $item) {
                $controllerName .= ucfirst($item);
            }
            $controllerName .= 'Controller';
            $controllerClass = "App\\Controller\\" . $controllerName;
            return call_user_func_array([new $controllerClass, $action], $params);
        };
        return $next();
    }
}