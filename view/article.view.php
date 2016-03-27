<?php
    require_once(dirname(dirname(__FILE__)) . '/autoload.php');
    $articel=Request::get('articel');
?>

<!doctype html>
<html>
<head>
    <title>Xnews - <?php echo $articel['title']?></title>
    <meta charset="utf-8">
</head>

<body>
    <?php var_dump($articel)?>
</body>
</html>
