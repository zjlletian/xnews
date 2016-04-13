<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class SourceController extends Controller{

    //检查管理员是否登陆
    function __construct(){
        if(!isset($_SESSION['admin'])) {
            $this->redirect('/auth/adminlogin');
        }
    }

    //源管理页面
    function index(){
        $model=new SourceModel();
        $list=$model->getSourceList();
        Request::put('list',$list);
        Request::put('tags',(new TagModel())->getlist());
        $this->view('admin/source');
    }

    //添加源
    function add(){
        $source['url']=$_POST['url'];
        $source['alias']=$_POST['alias'];
        $source['urlrule']=$_POST['urlrule'];
        $source['addtime']=Util::timestr();
        $source['titlerule']=$_POST['titlerule'];
        $source['contentrule']=$_POST['contentrule'];
        $source['imagerule']=$_POST['imagerule'];
        $source['updatetime']='0';
        $source['tag_id']=$_POST['tag'];
        if((new SourceModel())->insert($source)){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'存在相同源链接，添加失败'));
        }
    }

    //获取源信息
    function get(){
        $data=(new SourceModel())->find($_GET['sid']);
        $this->json($data);
    }

    //修改规则
    function modify(){
        $source['url']=$_POST['url'];
        $source['alias']=$_POST['alias'];
        $source['urlrule']=$_POST['urlrule'];
        $source['titlerule']=$_POST['titlerule'];
        $source['contentrule']=$_POST['contentrule'];
        $source['imagerule']=$_POST['imagerule'];
        $source['tag_id']=$_POST['tag'];
        if((new SourceModel())->update($_POST['sid'],$source)){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'存在相同源链接，添加失败'));
        }
    }

    //删除源
    function del(){
        if((new SourceModel())->delete($_POST['sid'])){
            $this->json(array('status'=>1));
        }
        else{
            $this->json(array('status'=>0,'msg'=>'删除失败'));
        }
    }
}
