<?php

namespace App\Passport\Controllers;

use App\Passport\Models\User;
use Framework\Request;

class AuthController extends Controller {

    protected $user;

    /**
     * AuthController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user) {
        //依赖注入User示例
        $this->user = $user;
        //构造器中间件使用示例
        $this->middleware('auth', ['login']);
    }

    /**
     * @param Request $request
     *
     * @return string
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function login(Request $request) {
        //Todo:请求参数验证
        //参数获取示例
        $this->user->username = $request->get('username');
        $this->user->password = $request->get('password');
        //示例响应
        $user = $this->user->username;
        $hash = password_hash($this->user->password, OPENSSL_ALGO_SHA1);
        $date = Date("Y-m-d H:i:s");
        $ip = get_real_ip();
        return 'User:' . $user . '<br>Hash:' . $hash . '<br>Login At:' . $date . "<br>IP:" . $ip;
    }
}
