<?php
require_once(dirname(dirname(__FILE__)).'/autoload.php');

//新浪娱乐实例
$sourceurl="http://ent.sina.com.cn/";
$urlrule="@^http://ent.sina.com.cn/(\w+)/(\w+)/(\d{4}-\d{2}-\d{2})/doc-(.*)$@"; //like http://ent.sina.com.cn/tv/zy/2016-03-28/doc-ifxqswxn6486920.shtml
$titlerule='#main_title';
$contentrule='#artibody p';
$imgrule='#artibody .img_wrapper img';

$urllist=UrlAnalyzer::getUrls($sourceurl,$urlrule);
foreach ($urllist as $link){
    $urlinfo=UrlAnalyzer::getInfo($link, $titlerule, $contentrule, $imgrule);
    echo $link."\n";
    echo "标题：".$urlinfo['title']."\n";
    echo "正文：".$urlinfo['content']."\n";
    echo "图片：".$urlinfo['images']."\n";
    echo "\n";
}
