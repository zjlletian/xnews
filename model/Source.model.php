<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class SourceModel extends Model{

    function __construct() {
        parent::__construct('source');
    }

    //获取源列表
    function getSourceList(){
        return DB::query("SELECT * FROM source,tag WHERE  source.tag_id=tag.id");
    }
}
