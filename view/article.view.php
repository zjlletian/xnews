<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');
$article=Request::get('article');
?>

<!doctype html>
<html>
<head>
    <title><?php echo $article['title']?> - Xnews</title>
    <?php include(APPROOT . '/view/template/head.php');?>
</head>

<body>
<h1><?php echo $article['title']?></h1>
<a href="<?php echo $article['url']?>" target="_blank">原链接： <?php echo $article['url']?></a>
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
</body>
</html>
