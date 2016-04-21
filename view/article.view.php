<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');
$article=Request::get('article');
?>

<!doctype html>
<html>
<head>
    <title><?php echo $article['title']?> - Xnews</title>
    <?php include(APPROOT . '/view/template/mhead.php');?>
</head>

<body>
<div class="page-group">
    <div class="page" id='articlepage'>
        <div class="content">
            <h1 class='title'><?php echo $article['title']?></h1>
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
</body>
</html>
