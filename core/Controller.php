<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class Controller{

    //获取http请求方法类型
    static function getRequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}
