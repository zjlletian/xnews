<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class IndexController extends Controller{

    //默认访问入口
    function emptymethod(){
        parent::emptymethod();
        if(Util::isMobileRequest()){
            $this->index();
        }
        else{
            $this->view('index');
        }
    }

    //首页
    function index() {
        $model=new ArticleModel();
        $list=$model->getArticelByTag();
        Request::put('list',$list);
        $this->view('mobile');
    }
}
