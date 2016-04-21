<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleModel extends Model{

    function __construct() {
        parent::__construct('article');
    }

    //获取对应列表数量
    function getArticleCount($sourceid){
        $s=$sourceid==null?'':' AND article.source_id='.$sourceid;
        return count(DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s}"));
    }

    //获取列表
    function getArticleList($size,$page,$sourceid){
        $from=($page-1)*$size;
        $s=$sourceid==null?'':' AND article.source_id='.$sourceid;
        return DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s} ORDER BY article.time DESC limit {$from},{$size}");
    }

    //
    function getArticelByTag($tag,$from){

    }
}
