<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class TagController extends Controller{

    //检查管理员是否登陆
    function __construct(){
        if(!isset($_SESSION['admin'])) {
            $this->redirect('/admin/login');
        }
    }

    //列表
    function index(){
        $model=new TagModel();
        $list=$model->getTagList();
        Request::put('list',$list);
        $this->view('admin/tag');
    }

    //添加
    function add(){
        if(empty($_POST['tagname'])){
            $this->json(array('status'=>0,'msg'=>'分类不能为空'));
        }
        $tag['tagname']=$_POST['tagname'];
        if((new TagModel())->insert($tag)){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'分类已'.$_POST['tagname'].'存在，添加失败'));
        }
    }

    //修改
    function modify(){
        $tag['tagname']=$_POST['tagname'];
        if((new TagModel())->update($_POST['sid'],$tag)){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'存在相同分类，添加失败'));
        }
    }

    //删除
    function del(){
        $tagid=$_POST['sid'];
        if(count((new SourceModel())->getSourceByTag($tagid))>0){
            $this->json(array('status'=>0,'msg'=>'该分类下存在源 , 删除失败'));
        }
        if((new TagModel())->delete($tagid)){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'删除失败'));
        }
    }

    //获取对应分类的源列表
    function tagsource(){
        $tagid=$_GET['id'];
        $this->json((new SourceModel())->getSourceByTag($tagid));
    }
}
