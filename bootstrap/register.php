<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2020/1/18
 * Time: 16:40
 */

//返回当前应用实例
$app = app();

//全局单例绑定 'user' 到 User 类
$app->bind('user', App\Entities\User::class, TRUE);