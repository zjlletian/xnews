<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleModel extends Model{

    function __construct() {
        parent::__construct('article');
    }

    //获取需要爬取信息的任务
    function getTask(){

    }
}
