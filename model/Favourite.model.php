<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

class FavouriteModel extends Model{

    function __construct() {
        parent::__construct('favourite');
    }

    //是否收藏
    function isFavourite($uid,$aid){
        return count($this->getlist("where article_id={$aid} and user_id={$uid}"))>0;
    }

    //添加收藏
    function addFavourite($uid,$aid){
        return $this->insert(array('user_id'=>$uid,'article_id'=>$aid,'time'=>time()));
    }

    //移除收藏
    function removeFavourite($uid,$aid){
        return DB::query("delete from favourite where article_id={$aid} and user_id={$uid}");
    }

    //获取收藏列表
    function getFavList($uid){
        return DB::query("SELECT article.*, favourite.time as favtime  FROM article, favourite WHERE article.id=favourite.article_id AND favourite.user_id={$uid} ORDER BY favourite.time desc");
    }
}
