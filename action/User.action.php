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
            if(!isset($_GET['relogin'])){
                $user=(new UserInfoModel())->check($_POST['username'], $_POST['password']);
            }
            else{
                $user=(new UserInfoModel())->check($_POST['username'], $_POST['password'],false);
            }
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
        $userinfo=array('name'=>$_POST['username'],'email'=>$_POST['email'],'password'=>md5($_POST['password']),'book'=>0);
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

    //退出登录
    function logout(){
        $this->cheklogin();
        unset($_SESSION['user']);
    }

    //分类列表
    function tags(){
        $tags=(new TagModel())->getlist();
        $this->json($tags);
    }

    //收藏列表
    function favlist(){
        $this->cheklogin();
        $model=new FavouriteModel();
        $list=$model->getFavList($_SESSION['user']['id']);
        Request::put('list',$list);
        $this->view('favlist');
    }

    //是否添加收藏
    function isFav(){
        $this->cheklogin();
        echo (new FavouriteModel())->isFavourite($_POST['uid'],$_POST['aid'])? 1:0;
    }

    //添加收藏
    function addFav(){
        $this->cheklogin();
        echo (new FavouriteModel())->addFavourite($_POST['uid'],$_POST['aid'])? 1:0;
    }

    //移除收藏
    function delFav(){
        $this->cheklogin();
        echo (new FavouriteModel())->removeFavourite($_POST['uid'],$_POST['aid'])? 1:0;
    }

    //提交评论
    function addComment(){
        $commentModel=new CommentsModel();
        $commentModel->insert(array(
            'user_id'=>$_POST['uid'],
            'article_id'=>$_POST['aid'],
            'comment'=>$_POST['comment'],
            'time'=>time()
        ));
        echo substr(Util::timestr(time()),0,16);
    }
}
