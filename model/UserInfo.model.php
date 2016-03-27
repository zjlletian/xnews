<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class UserInfoModel extends Model{

    function __construct() {
        parent::__construct('userinfo');
    }
}
