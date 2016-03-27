<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class IndexController extends Controller{

    //默认首页
    function index() {
        $this->view('index');
    }
}
