<?php
require_once(dirname(dirname(__FILE__)) . '/config.inc.php');

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

    //请求数据库，直接返回结果
    static function query($sql) {
        self::connect();
        return mysqli_query(self::$mycon, $sql);
    }

    //请求数据库，返回数组
    static function queryForArray($sql) {
        self::connect();
        $resultarry=array();
        $result= mysqli_query(self::$mycon, $sql);
        while($item=mysqli_fetch_assoc($result)){
            $resultarry[]=$item;
        }
        $result->free();
        return $resultarry;
    }
}