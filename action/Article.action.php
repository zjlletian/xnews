<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleController extends Controller{

    //权限判断
    function __construct(){
        if(Request::$queryMethod!='emptymethod' && !isset($_SESSION['admin'])) {
            $this->redirect('/admin/login');
        }
    }

    //重写emptymethod()，用于显示文章页面
    function emptymethod() {
        if(!isset($_GET['id'])){
            $this->notfind("miss id");
        }
        $articelmodel=new ArticleModel();
        if(null == $article=$articelmodel->getArticle($_GET['id'])){
            $this->notfind();
        }
        $articelmodel->increaseView($article['id']);
        Request::put('article',$article);
        if(isset($_GET['pre'])){
            $this->view('admin/preview');
        }
        else{
            $this->view('article');
        }
    }

    //列表
    function index(){
        if(!isset($_GET['p'])){
            $this->redirect('/article/?p=1');
        }
        $sourceid=null;
        if(!isset($_GET['s'])){
            Request::put('pageurl','/article/?p=');
        }
        else{
            $sourceid=$_GET['s'];
            Request::put('pageurl','/article/?s='.$sourceid.'&p=');
        }

        $model=new ArticleModel();
        $totalcount=$model->getArticleCount($sourceid);
        $pagesize=10;
        $pages=intval($totalcount/$pagesize);
        $pages=$totalcount%$pagesize>0?$pages+1:$pages;
        $p=intval($_GET['p']);
        $p=$p>$pages?$pages:$p;
        $p=$p<1?1:$p;
        $list=$model->getArticleList($pagesize,$p,$sourceid);
        Request::put('total',$totalcount);
        Request::put('page',$p);
        Request::put('pages',$pages);
        Request::put('list',$list);
        Request::put('source',(new SourceModel())->getlist());
        $this->view('admin/article');
    }

    //删除
    function del(){
        if((new ArticleModel())->update($_POST['sid'],array('status'=>-1))){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'删除失败'));
        }
    }
}
