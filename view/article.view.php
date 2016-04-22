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
        <div class="content">
            <h3><?php echo $article['title']?></h3>
            <div class="content-block">
                <a href="<?php echo $article['url']?>" target="_blank" class="external">原链接： <?php echo $article['url']?></a>
                <br>
                <?php
                echo $article['content'];
                $imgs=explode("$$",$article["images"]);
                foreach ($imgs as $img){
                    if(!strstr($img,'@@')){
                        echo "<img src='{$img}'/><br><br>";
                    }
                    else{
                        $img=explode('@@',$img);
                        echo "<img src='{$img[0]}'/><br>$img[1]<br><br>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
