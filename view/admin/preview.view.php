<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
    $article=Request::get('article');
?>

<!doctype html>
<html>
<head>
    <title>Xnews 规则预览</title>
    <meta charset="utf-8">
</head>

<body>
    <h1><?php echo $article['title']?></h1>
    <a href="<?php echo $_POST['u']?>" target="_blank">原链接： <?php echo $_POST['u']?></a>
    <br>
    <?php
        echo $article['content'];
        $imgs=explode("\n",$article["images"]);
        foreach ($imgs as $img){
            echo "<img src='{$img}'/> <br>";
        }
    ?>
</body>
</html>
