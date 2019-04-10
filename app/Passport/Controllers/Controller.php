<?php

namespace App\Passport\Controllers;

use App\Passport\Middleware\AuthByPassword;
use Framework\Request;

/**
 * Class Controller
 * @package App\Passport\Controllers
 */
class Controller {
    //Todo:BaseController
    public function middleware($method, $excepts = []) {
        //Todo:Constructor Middleware
        //下面是假装搞了一下
        if ($method == 'auth') {
            return (new AuthByPassword())->handle(new Request());
        }
    }
}
