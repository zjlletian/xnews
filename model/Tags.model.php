<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class TagsModel extends Model{

    function __construct() {
        parent::__construct('tags');
    }
}
