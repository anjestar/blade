<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 16:12
 */

namespace App\Controller;


use App\Constant\ErrorCode;

class IndexController extends Controller
{
    public function index()
    {

        $this->user->id = request('id', '2');
        if ($this->user->id != 1) {
            $this->error(ErrorCode::UNAUTHORIZED);
        }
        $this->user->name = 'gecco';
        return $this->success([
            'user' => [
                'table' => $this->user->getTable(),
                'attributes' => $this->user,
            ]
        ]);
    }
}