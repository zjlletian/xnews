<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class IndexController extends Controller{

    //默认访问入口
    function emptymethod(){
        parent::emptymethod();
        if(Util::isMobileRequest()){
            $this->view('mobile');
        }
        else{
            $this->view('index');
        }
    }

    //新闻列表
    function newslist(){
        $model=new ArticleModel();
        $list=$model->getArticelByTag($_GET['t']);
        Request::put('list',$list);
        $this->view('newslist');
    }

    //获取所有分类
    function tags() {
        $model=new TagModel();
        $list=$model->getlist();
        $this->json($list);
    }
}
