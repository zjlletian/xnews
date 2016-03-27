<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class AdminModel extends Model{

    function __construct() {
        parent::__construct('admin');
    }
}
