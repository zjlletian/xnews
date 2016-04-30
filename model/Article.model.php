<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleModel extends Model{

    function __construct() {
        parent::__construct('article');
    }

    //获取对应列表数量
    function getArticleCount($sourceid=null){
        $s=$sourceid==null?'':' AND article.source_id='.$sourceid;
        return DB::query("SELECT count(*) as c FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s}")[0]['c'];
    }

    //获取列表
    function getArticleList($size,$page,$sourceid=null){
        $from=($page-1)*$size;
        $s=$sourceid==null?'':' AND article.source_id='.$sourceid;
        return DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s} ORDER BY article.time DESC limit {$from},{$size}");
    }

    //获取最新的文章列表
    function getArticelByTag($tagid=null){
        $s=$tagid==null?'':' AND source.tag_id='.$tagid;
        return DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 {$s} ORDER BY article.time DESC limit 50");
    }

    //获取文章详情
    function getArticle($id){
        $array=DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 AND article.id={$id}");
        return count($array)==1?$array[0]:null;
    }

    //增加访问量
    function increaseView($id){
        return DB::query("UPDATE article SET article.view=article.view+1 WHERE article.id={$id}");
    }
}
