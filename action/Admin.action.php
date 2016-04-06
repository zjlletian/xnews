<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AdminController extends Controller{

    //检查管理员是否登陆
    function __construct(){
        if(!isset($_SESSION['admin'])) {
            $this->redirect('/auth/adminlogin');
        }
    }

    //管理员首页
    function index(){
        $this->view('admin/index');
    }

    //规则测试页面
    function test() {
        if(isset($_GET['sid'])){

        }
        if(isset($_POST['url']) && isset($_POST['urlrule'])){
            $urllist=UrlAnalyzer::getUrls($_POST['url'],"@".$_POST['urlrule']."@");
            Request::put('urllist',$urllist);
        }
        $this->view('admin/test');
    }

    //规则测试预览
    function preview(){
        Request::put('article',UrlAnalyzer::getInfo($_POST['u'], $_POST['t'], $_POST['c'], $_POST['i']));
        $this->view('admin/preview');
    }
}
