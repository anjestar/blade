<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 15:27
 */

namespace Blade;


class Response
{
    private static $encoder;

    public static function setJsonEncoder()
    {
        self::$encoder = function ($res, $status) {
            header('Content-Type', 'application/json');
            http_response_code($status);
            exit(json_encode($res));
        };
    }

    public static function content($data, $status = 200)
    {
        return call_user_func(self::$encoder, $data, $status);
    }
}