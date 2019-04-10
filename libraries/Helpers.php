<?php

/**
 * @return mixed
 * @author Gecco <up.lxin@gmail.com>
 * @date   2019/4/10
 */
function get_real_ip() {
    return $_SERVER['REMOTE_ADDR'];
}
