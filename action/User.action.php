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
        $result=array('code'=>1);
        if(Request::method()=="POST"){
            $user=(new UserInfoModel())->check($_POST['username'], $_POST['password']);
            if(!empty($user)){
                $_SESSION['user']= $user;
                $result['user']=$user;
            }
            else{
                $result['code']=0;
                $result['msg']='用户名密码错误';
            }
        }
        $this->json($result);
    }

    //用户注册
    function regist(){
        $result=array('code'=>1);
        $usermodel=new UserInfoModel();
        $userinfo=array('name'=>$_POST['username'],'email'=>$_POST['email'],'password'=>md5($_POST['password']));
        if(!empty($usermodel->getOne("where name='{$_POST['username']}'"))){
            $result['code']=0;
            $result['msg']='用户名已存在';
        }
        elseif(!empty($usermodel->getOne("where email='{$_POST['email']}'"))){
            $result['code']=0;
            $result['msg']='邮箱已被使用';
        }
        elseif(!$usermodel->insert($userinfo)){
            $result['code']=0;
            $result['msg']='写入数据库失败';
        }
        $this->json($result);
    }

    //分类列表
    function tags(){
        $tags=(new TagModel())->getlist();
        $this->json($tags);
    }
}
