<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class Controller{

    //空方法时调用
    public function emptymethod(){
        if(!empty(Request::$queryController)){
            $this->redirect('/'.Request::$queryController.'/',301);
        }
    }

    //显示视图页面
    public function view($view){
        $page=APPROOT.'/view/'.$view.'.view.php';
        include($page);
        exit();
    }

    //将数组转化为json返回
    public function json($data){
        header('Content-type:text/json;charset:utf-8');
        echo json_encode($data);
        exit();
    }

    //重定向
    public function redirect($url,$code=302){
        http_response_code($code);
        header('Location: '.$url);
        exit();
    }

    //404错误页面
    public function notfind($msg="can't find page"){
        http_response_code(404);
        echo $msg;
        exit();
    }
}
