<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 15:27
 */

namespace Blade;


class Middleware
{
    public static function getGlobalMiddlewares()
    {
        return [];
    }

    public static function getMiddlewares()
    {
        return [];
    }

    public static function runMiddlewares($middlewares, $next)
    {
        foreach ($middlewares as $middleware) {
            $next = function () use ($middleware, $next) {
                call_user_func_array([new $middleware, 'handle'], [Blade::$request, $next]);
            };
        }
        return $next;
    }
}