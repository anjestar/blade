<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2020/1/18
 * Time: 16:37
 */

namespace App\Entities;

class User
{
    protected $table = 'users';

    public function getTable()
    {
        return $this->table;
    }
}