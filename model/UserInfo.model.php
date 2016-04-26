<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class UserInfoModel extends Model{

    function __construct() {
        parent::__construct('userinfo');
    }

    //检查用户名密码是否正确
    function check($name,$password,$enc=true){
        if($enc){
            $password=md5($password);
        }
        $user=$this->getlist("where name='{$name}' AND password='{$password}' ");
        if(empty($user)){
            return false;
        }
        else{
            return $user[0];
        }
    }
}
