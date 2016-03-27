<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class DB {

    //mysql连接
    static private $mycon;

    //构造函数，连接数据库
    static private function connect() {
        if(self::$mycon==null){
            self::$mycon=mysqli_connect($GLOBALS['MYSQL']['host'],$GLOBALS['MYSQL']['user'],$GLOBALS['MYSQL']['passwd'],$GLOBALS['MYSQL']['db'],$GLOBALS['MYSQL']['port']);
            if(mysqli_connect_error()!=null) {
                die(mysqli_connect_error());
            }
        }
    }

    //请求数据库，返回结果 bool 或 array
    static function query($sql) {
        self::connect();
        $result=mysqli_query(self::$mycon, $sql);
        if(is_bool($result)){
            return $result;
        }
        $resultarry=array();
        while($item=mysqli_fetch_assoc($result)){
            $resultarry[]=$item;
        }
        $result->free();
        return $resultarry;
    }

    //替换特殊字符
    static function escape($str){
        self::connect();
        return mysqli_real_escape_string(self::$mycon,$str);
    }
}
