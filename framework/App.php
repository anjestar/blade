<?php

namespace Framework;

class App {

    /**
     * @throws \ReflectionException
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function run() {
        //初始化错误捕获
        set_exception_handler(function ($exception) {
            header('Content-Type', 'application/json');
            echo json_encode([
                'msg' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);
        });
        //初始化容器
        $container = new Container();
        //绑定请求
        $container->singleton('request', 'Framework\Request');
        //Todo:运行全局中间件
        $auth = $container->make('App\Passport\Controllers\AuthController');
        //Todo:自动对方法进行依赖注入
        $request = $container->make('request');
        $result = call_user_func_array([$auth, 'login'], [$request]);
        //Todo:响应处理
        echo $result;
    }

}
