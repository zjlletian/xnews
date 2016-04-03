<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AdminModel extends Model{

    function __construct() {
        parent::__construct('admin');
    }

    //检查用户名密码是否正确
    function check($name,$password){
        $password=md5($password);
        $admin=$this->where("name='{$name}' AND password='{$password}' ");
        if(empty($admin)){
            return false;
        }
        else{
            return $admin[0];
        }
    }
}
