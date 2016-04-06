<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleController extends Controller{

    //文章页面
    function emptyMethod() {
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
    
    //检查管理员登陆
    private function checkAdmin(){
        if(!isset($_SESSION['admin'])) {
            $this->redirect('/auth/adminlogin');
        }
    }
}
