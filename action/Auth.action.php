<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AuthController extends Controller{
    
    //管理员登录
    function adminlogin(){
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
}
