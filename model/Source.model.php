<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class SourceModel extends Model{

    function __construct() {
        parent::__construct('source');
    }

    //获取源列表
    function getSourceList(){
        return DB::query("SELECT source.*,tag.tagname FROM source,tag WHERE  source.tag_id=tag.id");
    }

    //获取需要爬取url的源任务
    function getTask(){
        return $this->getlist('where updatetime<'.(time()-1800));
    }

    //根据分类获取source列表
    function getSourceByTag($tagid){
        return $this->getlist('where tag_id='.$tagid);
    }
}
