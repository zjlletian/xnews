<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class SourceModel extends Model{

    function __construct() {
        parent::__construct('source');
    }
}
