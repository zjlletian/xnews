<?php
    require_once(dirname(dirname(__FILE__)) . '/autoload.php');
    $articel=Request::get('articel');
?>

<!doctype html>
<html>
<head>
    <title>Xnews - <?php echo $articel['title']?></title>
    <?php include(APPROOT.'/public/head.php');?>
</head>

<body>
    <?php var_dump($articel)?>
</body>
</html>
