<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class UserController extends Controller{

    //检查是否登陆
    function cheklogin(){
        if(!isset($_SESSION['user'])) {
            $this->json(array('msg'=>'未登录', 'code'=>0));
        }
    }

    //用户登录
    function login(){
        if(Request::method()=="POST"){

        }
    }

    //用户注册
    function regist(){
        $result=array('code'=>1);
        $usermodel=new UserInfoModel();
        $userinfo=array('name'=>$_POST['username'],'email'=>$_POST['email'],'password'=>md5($_POST['password']));
        if($usermodel->insert($userinfo)){
            
        }
        else{

        }
    }

    //分类列表
    function tags(){
        $tags=(new TagModel())->getlist();
        $this->json($tags);
    }
}
