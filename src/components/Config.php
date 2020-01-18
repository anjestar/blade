<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 16:03
 */

namespace Blade;


class Config
{
    public static function init()
    {
        $files = scandir(__ROOT__ . '/config/');
        foreach ($files as $file) {
            $fileArr = explode('.', $file);
            if (count($fileArr) == 2 && $fileArr[1] == 'php') {
                Blade::$config[$fileArr[0]] = require __ROOT__ . '/config/' . $file;
            }
        }
    }
}