<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AdminController extends Controller{

    //检查管理员是否登陆
    function __construct(){
        if(!isset($_SESSION['admin']) && Request::$queryMethod!='login') {
            $this->redirect('/admin/login');
        }
    }

    //管理员登录
    function login(){
        if(Request::method()=="POST"){
            $admin=(new AdminModel())->check($_POST['name'], $_POST['password']);
            if(!empty($admin)){
                $_SESSION['admin']=$admin;
                $this->redirect('/admin/');
            }
            else{
                Request::put('msg','用户名或密码错误');
            }
        }
        $this->view('admin/login');
    }

    //注销登陆
    function logout(){
        unset($_SESSION['admin']);
        $this->redirect('/admin/login');
    }

    //管理员首页
    function index(){
        $this->redirect('/source/');
    }

    //规则测试页面
    function test() {
        if(isset($_POST['url']) && isset($_POST['urlrule'])){
            $urllist=UrlAnalyzer::getUrls($_POST['url'],"@".$_POST['urlrule']."@");
            Request::put('urllist',$urllist);
        }
        $this->view('admin/test');
    }

    //规则测试预览
    function preview(){
        $article=UrlAnalyzer::getInfo($_POST['u'], $_POST['t'], $_POST['c'], $_POST['i']);
        $article['url']=$_POST['u'];
        Request::put('article',$article);
        $this->view('admin/preview');
    }
}
