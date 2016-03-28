<?php
require_once(dirname(dirname(__FILE__)).'/autoload.php');

//新浪娱乐实例
$htmltext=UrlAnalyzer::getHtml('http://ent.sina.com.cn/y/yrihan/2016-03-28/doc-ifxqswxk9732217.shtml');
$urlinfo=UrlAnalyzer::htmlExtract($htmltext, '#main_title', '#artibody p');

echo "标题：".$urlinfo['title']."\n";
echo "正文：".$urlinfo['content']."\n";
