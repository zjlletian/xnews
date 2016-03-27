<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class Controller{
    //显示视图页面
    protected function view($view){
        $page=APPROOT.'/view/'.$view.'.view.php';
        include($page);
        exit();
    }

    //将数组转化为json返回
    protected function json($data){
        header('Content-type:text/json;charset:utf-8');
        echo json_encode($data);
        exit();
    }

    //重定向
    protected function redirect($url){
        header('Location: '.$url);
        exit();
    }

    //404错误页面
    protected function notfind($msg="can't find page"){
        http_response_code(404);
        echo $msg;
        exit();
    }
}
