<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleController extends Controller{

    //权限判断
    function __construct(){
        if(Request::$queryMethod!='emptyMethod' && !isset($_SESSION['admin'])) {
            $this->redirect('/auth/adminlogin');
        }
    }

    //重写emptyMethod()，用于显示文章页面
    function emptyMethod() {
        if(!isset($_GET['id'])){
            $this->notfind("miss id");
        }
        $articelmodel=new ArticleModel();

        if(null == $article=$articelmodel->find($_GET['id'])){
            $this->notfind();
        }
        Request::put('article',$article);
        $this->view('article');
    }

    //管理员，文章列表
    function index(){

    }
}
