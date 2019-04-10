<?php

namespace App\Passport\Middleware;

use App\Passport\Models\User;
use Framework\Request;

/**
 * Class AuthByPassword
 * @package \App\Passport\Middleware
 */
class AuthByPassword {
    public function handle(Request $request) {
        //从请求拿到参数
        $username = $request->input('username');
        $password = $request->input('password');
        //模拟一个从数据库拿到的User数据
        $user = new User();
        $user->username = $username;
        $user->password = '123456';
        //开始验证
        $hash = password_hash($user->password, OPENSSL_ALGO_SHA1);
        if (!password_verify($password, $hash)) {
            throw new \Exception("401 Unauthorized.", 10001);
        }
    }
}
