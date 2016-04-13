<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class TagModel extends Model{

    function __construct() {
        parent::__construct('tag');
    }

    //获取tag信息
    function getTagList(){
        return DB::query("select a.*, ifnull(b.tagcount,0) as sourcecount from tag a left join (select tag_id,count(id) as tagcount from source group by tag_id) b on a.id=b.tag_id");
    }
    
}
