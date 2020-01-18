<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 16:33
 */

namespace App\Constant;

final class ErrorCode
{
    //应用错误码
    const SERVER_ERROR = 10000;
    const BAD_REQUEST = 10001;
    const UNAUTHORIZED = 10002;
    const ACCESS_DENY = 10003;
    //用户相关错误码
    const EMAIL_EXISTS = 20000;
    const USERNAME_EXISTS = 20001;
    const USER_NOT_ACTIVE = 20002;
    const USER_FORBIDDEN = 20003;
}