<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class View{

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
    
    //显示页面
    static function show($view){
        $page=APPROOT.'/view/'.$view.'.view.php';
        include($page);
    }
}
