<?php

namespace App\Passport\Models;

/**
 * Class Model
 * @package \App\Passport\Models
 */
class Model {

    protected $data;

    /**
     * @param $key
     *
     * @return mixed|null
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function __get($key) {
        return $this->data[$key] ?? null;
    }

    /**
     * @param $key
     * @param $value
     *
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function __set($key, $value) {
        $this->data[$key] = $value;
    }
}
