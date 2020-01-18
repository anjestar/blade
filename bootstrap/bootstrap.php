<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 15:58
 */

require '../vendor/autoload.php';

define("__ROOT__", __DIR__ . "/../");
define("APP_DEBUG", true);

Blade\Blade::init();
Blade\Config::init();
Blade\Router::runImplicit();
Blade\Response::setJsonEncoder();

include 'register.php';
