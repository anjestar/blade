<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 16:12
 */

namespace App\Controller;

use App\Traits\JsonRespTrait;
use Blade\Blade;
use Exception;

/**
 * Class Controller
 *
 * @package App\Controller
 * @property \App\Entities\User $user
 */
class Controller
{
    use JsonRespTrait;

    public function user()
    {
        return Blade::$app->user;
    }

    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        } else {
            throw new Exception("无法获取属性：{$name}", 1001);
        }
    }

}