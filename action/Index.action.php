<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class IndexController extends Controller{

    //默认主页
    static function index() {
        View::put('data',"xnews index");
        View::show('index');
    }
}
