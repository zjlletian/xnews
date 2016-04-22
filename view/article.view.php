<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');
$article=Request::get('article');
?>
<div class="page-group">
    <div class="page" id='articlepage'>
        <input type="hidden" id="pagename" value="article">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left back"></span></a>
            <h1 class="title" id="maintitle">Xnews - 文章详情</h1>
            <a class="button button-link pull-right" onclick="addfavourite()" ><span class="fa fa-lg fa-star-o" id="likestar" data-liked="false"></span></a>
        </header>
        <div class="content" style="background-color:white;">
            <div class="content-block">
                <div class="article-header">
                    <h3 class="article-title"><?php echo $article['title']?></h3>
                    <div class="article-info"><?php echo $article['alias'].' '.substr(Util::timestr($article['time']),0,16)?> &nbsp;&nbsp;阅读 <?php echo $article['view']?></div>
                </div>
                <div class="article-content">
                    <?php
                    echo $article['content'];
                    foreach (explode("$$",$article["images"]) as $img){
                        if(!strstr($img,'@@')){
                            echo "<img src='{$img}' style='max-width: 100%' /><br><br>";
                        }
                        else{
                            $img=explode('@@',$img);
                            echo "<img src='{$img[0]}' style='max-width: 100%'/><br>";
                            echo "$img[1]<br><br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
