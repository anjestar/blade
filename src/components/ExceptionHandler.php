<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 15:28
 */

namespace Blade;


class ExceptionHandler
{
    public static function handleException(\Throwable $exception)
    {
        $basePath = __ROOT__ . '/runtime/logs/';
        $logPath = $basePath . 'blade-' . date("Y-m-d") . '.log';
        if (!file_exists($logPath)) {
            mkdir($basePath, '755', TRUE);
        }
        $datetime = date("Y-m-d H:i:s");
        $trace = json_encode($exception->getTrace()[0]);
        $log = "{$datetime}|[level]|{$exception->getMessage()}|{$exception->getCode()}|{$exception->getFile()}|{$exception->getLine()}|{$trace}\n";
        file_put_contents($logPath, $log, FILE_APPEND);
        $data = [
            'msg' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ];
        if (APP_DEBUG == TRUE) {
            $data['trace'] = $exception->getTrace()[0];
        }
        $code = config('responsecode.zh.' . $data['code'] . '.1', 500);
        Response::content($data, $code);
    }

    public static function boot()
    {
        set_exception_handler([ExceptionHandler::class, 'handleException']);
    }
}
