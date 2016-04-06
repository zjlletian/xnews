<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class UserTagsModel extends Model{

    function __construct() {
        parent::__construct('usertags');
    }
}
