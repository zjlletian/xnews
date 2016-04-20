<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class ArticleModel extends Model{

    function __construct() {
        parent::__construct('article');
    }

    function getAticleCount(){
        return count(DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1"));
    }

    function getAticleList($size,$page){
        $from=($page-1)*$size;
        return DB::query("SELECT article.*, source.alias, tag.tagname FROM article, source, tag WHERE  source.tag_id=tag.id AND article.source_id=source.id AND article.status=1 ORDER BY article.time DESC limit {$from},{$size}");
    }
}
