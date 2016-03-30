<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AdminController extends Controller{

    //规则测试页面
    function test() {
        if(Request::method()=="POST"){
            $urllist=UrlAnalyzer::getUrls($_POST['sourceurl'],"@".$_POST['urlrule']."@");
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
