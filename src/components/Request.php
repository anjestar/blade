<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 15:27
 */

namespace Blade;


class Request
{
    public static function get($key, $default = null)
    {
        if (isset($_GET[$key])) {
            return htmlspecialchars($_GET[$key]);
        }
        return $default;
    }

    public static function post($key, $default = null)
    {
        if (isset($_POST[$key])) {
            return htmlspecialchars($_POST[$key]);
        }
        return $default;
    }

    public static function input($key, $default = null)
    {
        if (isset($_REQUEST[$key])) {
            return htmlspecialchars($_REQUEST[$key]);
        }
        return $default;
    }

    public static function getContent()
    {
        return htmlspecialchars(file_get_contents("php://input"));
    }

    /**
     * 获取请求ip
     *
     * @return string ip地址
     */
    public static function getClientIp()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '';
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    }
}