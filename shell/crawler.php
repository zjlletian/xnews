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
        foreach ($urls as $url){
            $exist=$articleModel->getlist('where url=\''.DB::escape($url).'\'');
            if(count($exist)>0){
                continue;
            }
            $article=array(
                'url'=>$url,
                'time'=>time(),
                'status'=>1,
                'source_id'=>$source['id']
            );
            $articleinfo=UrlAnalyzer::getInfo($url,$source['titlerule'],$source['contentrule'],$source['imagerule']);
            if($articleinfo!=null){
                if(empty($articleinfo['title'])){
                    echo '子链接：'.$url." 未分析出标题\n";
                    $article['status']=2;
                }
                elseif(empty($articleinfo['content'])){
                    echo '子链接：'.$url." 未分析出正文\n";
                    $article['status']=3;
                }
                else{
                    $article['title']=$articleinfo['title'];
                    $article['content']=$articleinfo['content'];
                    $article['images']=$articleinfo['images'];
                    echo '子链接：'.$url." 标题：".$article['title']."\n";
                }
            }
            else{
                echo '子链接：'.$url." 获取信息失败\n";
                $article['status']=0;
            }
            if(!$articleModel->insert($article)){
                echo "写入数据库失败\n";
            }
        }
        echo "分析完成\n\n";
        $sourceModel->update($source['id'],array('updatetime'=>time()));
    }
    sleep(300);
}
