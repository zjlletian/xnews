<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class IndexController extends Controller{

    //默认访问入口
    function emptymethod(){
        parent::emptymethod();
        $this->index();
    }

    //首页
    function index() {
        $this->view('index');
    }
}
