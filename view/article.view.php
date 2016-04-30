<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');
$article=Request::get('article');
?>
<div class="page-group">
    <div class="page" id='articlepage'>
        <input type="hidden" id="articleid" value="<?php echo $article['id']?>">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left back"></span></a>
            <h1 class="title" id="maintitle">Xnews - 文章详情</h1>
            <a class="button button-link pull-right" onclick="addfavourite()" >
                <?php
                if(Request::get('fav')){
                    echo "<span class=\"fa fa-lg fa-star\" id=\"likestar\" data-liked=\"true\" data-aid='{$article['id']}'></span>";
                }
                else{
                    echo "<span class=\"fa fa-lg fa-star-o\" id=\"likestar\" data-liked=\"false\" data-aid='{$article['id']}'></span>";
                }
                ?>

            </a>
        </header>
        <div class="content" style="background-color:white;">
            <div class="content-block">
                <div class="article-header">
                    <h3 class="article-title"><?php echo $article['title']?></h3>
                    <div class="article-info"><?php echo  $article['alias'].' · '.substr(Util::timestr($article['time']),0,16)?> · 阅读 <?php echo $article['view']?></div>
                </div>
                <div class="article-content">
                    <?php
                    echo $article['content'];
                    if(!strpos($article['images'],'#@#@#')){
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
                    }
                    ?>
                </div>
                <div class="article-comments">
                    <textarea placeholder="请填写评论内容" id="comment"></textarea>
                    <div class="row">
                        <div class="col-50"><button class="button button-link" onclick="addcoomment()">发表评论</button></div>
                        <div class="col-50 " style="margin-left: -20%; margin-top:0.4rem ;font-size: 0.6rem; color:#777777;">请文明发言</div>
                    </div>
                    <br>
                    <?php $comments=Request::get('comments')?>
                    <?php if(empty($comments)):?>
                        <div id="nocomment">暂无人评论，快来抢占沙发吧！</div>
                    <?php endif ?>
                </div>
            </div>
            <div id="commentlist" style="margin-top: -30px">
                <?php foreach($comments as $item):?>
                    <div class="card comment">
                        <div class="card-header commentheader">
                            <span class="commentname"><?php echo $item['name']?></span>
                            <span class="commenttime">发表于 <?php echo substr(Util::timestr($item['time']),0,16)?></span>
                        </div>
                        <div class="card-content">
                            <div class="card-content-inner commenttext">
                                <?php echo $item['comment']?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <br><br><br><br>
        </div>
    </div>
</div>
