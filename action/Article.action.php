<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleController extends Controller{

    //文章首页
    function index() {
        if(!isset($_GET['id'])){
            $this->notfind("miss id");
        }
        $articelmodel=new ArticleModel();

        if(null == $articel=$articelmodel->find($_GET['id'])){
            $this->notfind();
        }
        Request::put('articel',$articel);
        $this->view('article');
    }
}
