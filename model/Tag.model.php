<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class TagModel extends Model{

    function __construct() {
        parent::__construct('tag');
    }
}
