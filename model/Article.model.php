<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleModel extends Model{

    function __construct() {
        parent::__construct('article');
    }

    function getAticleCount($sourceid){
        $s=$sourceid==null?'':' AND article.source_id='.$sourceid;
        return count(DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s}"));
    }

    function getAticleList($size,$page,$sourceid){
        $from=($page-1)*$size;
        $s=$sourceid==null?'':' AND article.source_id='.$sourceid;
        return DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s} ORDER BY article.time DESC limit {$from},{$size}");
    }
}
