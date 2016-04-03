<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AdminController extends Controller{

    //检查管理员是否登陆
    private function checklogin(){
        if(!isset($_SESSION['admin'])) {
            $this->redirect('/admin/login');
        }
    }

    //管理员首页
    function index(){
        $this->checklogin();
        $this->view('admin/index');
    }

    //管理员登录
    function login(){
        if(Request::method()=="POST"){
            $admin=(new AdminModel())->check($_POST['name'], $_POST['password']);
            if(!empty($admin)){
                $_SESSION['admin']=$admin['name'];
                $this->redirect('/admin/');
            }
            else{
                Request::put('msg','用户名或密码错误');
            }
        }
        $this->view('admin/login');
    }

    //规则测试页面
    function test() {
        $this->checklogin();
        if(Request::method()=="POST"){
            $urllist=UrlAnalyzer::getUrls($_POST['sourceurl'],"@".$_POST['urlrule']."@");
            Request::put('urllist',$urllist);
        }
        $this->view('admin/test');
    }

    //规则测试预览
    function preview(){
        $this->checklogin();
        Request::put('article',UrlAnalyzer::getInfo($_POST['u'], $_POST['t'], $_POST['c'], $_POST['i']));
        $this->view('admin/preview');
    }
}
