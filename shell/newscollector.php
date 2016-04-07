<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

while(true){
    $sourceModel=new SourceModel();
    $articleModel=new ArticleModel();

    //获取新的链接
    $sourcelist=$sourceModel->getTask();
    foreach ($sourcelist as $source){
        echo '分析源:'.$source['url']."\n";
        $urls=UrlAnalyzer::getUrls($source['url'],'@'.$source['urlrule'].'@');
        var_dump($urls);
        foreach ($urls as $url){
            $article=array(
                'url'=>$url,
                'time'=>time(),
                'status'=>0,
                'tag_id'=>$source['tag_id']
            );
            echo '子链接：'.$url."\n";
            $articleModel->insert($article);
        }
        echo "\n";
    }
    sleep(600);
}
