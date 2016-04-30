<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class CommentsModel extends Model{

    function __construct() {
        parent::__construct('comments');
    }

    function getArticleComment($aid){
        return DB::query("select userinfo.name,comments.* from userinfo,comments where userinfo.id=comments.user_id AND comments.article_id={$aid}");
    }
}
