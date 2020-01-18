<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 16:23
 */

namespace App\Traits;

use Blade\HttpCode;
use Blade\Response;

trait JsonRespTrait
{
    public function success($data)
    {
        return $this->respond($data);
    }

    public function respond($data, $msg = 'ok', $code = 0, $statusCode = 200)
    {
        header(HttpCode::$maps[$statusCode]);
        return Response::content([
            'msg' => $msg,
            'code' => $code,
            'data' => $data
        ]);
    }

    public function error($code, $msg = '', $statusCode = null)
    {
        $statusCode = $statusCode ?: config('responsecode.zh.' . $code . '.1');
        header(HttpCode::$maps[$statusCode]);
        throw new \Exception($msg ?: config('responsecode.zh.' . $code . '.0'), $code);
    }
}