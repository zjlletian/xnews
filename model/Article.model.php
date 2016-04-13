<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleModel extends Model{

    function __construct() {
        parent::__construct('article');
    }
    
}
