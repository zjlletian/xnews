<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class CommentsModel extends Model{

    function __construct() {
        parent::__construct('comments');
    }
}
