<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/27
 * Time: 10:48
 */


if (!function_exists('app')) {
    function app()
    {
        return \Blade\Blade::$app;
    }
}

if (!function_exists('config')) {
    function config($key, $default = NULL)
    {
        $fields = explode('.', $key);
        $config = \Blade\Blade::$config;
        $current = $config;
        foreach ($fields as $field) {
            if (isset($current[$field])) {
                $current = $current[$field];
            } else {
                return $default;
            }
        }
        return $current;
    }
}

if (!function_exists('request')) {
    function request($key, $default = NULL)
    {
        return \Blade\Request::input($key, $default);
    }
}

