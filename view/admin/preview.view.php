<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
    $article=Request::get('article');
?>

<!doctype html>
<html>
<head>
    <title>Xnews</title>
    <meta charset="utf-8">
</head>

<body>
    <h1><?php echo $article['title']?></h1>
    <?php
        echo $article['content'];
        $imgs=explode("\n",$article["images"]);
        foreach ($imgs as $img){
            echo "<img src='{$img}'/> <br>";
        }
    ?>
</body>
</html>
