<?php

namespace Framework;

/**
 * Class Request
 * @package \Framework
 */
class Request {
    /**
     * @param        $name
     * @param string $default
     *
     * @return string
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function get($name, $default = '') {
        return htmlspecialchars($_GET[$name] ?? $default);
    }

    /**
     * @param        $name
     * @param string $default
     *
     * @return string
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function post($name, $default = '') {
        return htmlspecialchars($_POST[$name] ?? $default);
    }

    /**
     * @param        $name
     * @param string $default
     *
     * @return string
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function input($name, $default = '') {
        return htmlspecialchars($_REQUEST[$name] ?? $default);
    }

    /**
     * @param        $name
     * @param string $default
     *
     * @return string
     * @author Gecco <up.lxin@gmail.com>
     * @date   2019/4/10
     */
    public function file($name, $default = '') {
        return $_FILES[$name] ?? $default;
    }
}
