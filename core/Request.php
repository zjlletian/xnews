<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class Request{

    //页面数据
    private static $data=array();

    //存入值
    static function put($key,$value){
        self::$data[$key]=$value;
    }

    //获取存入的值
    static function get($key){
        return self::$data[$key];
    }

    //获取http请求类型
    protected static function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}
