<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
    $article=Request::get('article');
?>

<!doctype html>
<html>
<head>
    <title>Xnews 规则预览</title>
    <?php include(APPROOT . '/view/template/head.php');?>
</head>

<body>
    <h1><?php echo $article['title']?></h1>
    <a href="<?php echo $article['url']?>" target="_blank">原链接： <?php echo $article['url']?></a>
    <br>
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
</body>
</html>
