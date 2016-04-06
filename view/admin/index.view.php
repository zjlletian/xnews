<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>

<!doctype html>
<html>
<head>
    <title>Xnews 控制中心</title>
    <?php include(APPROOT.'/public/head.php');?>
</head>

<body>
    Xnews 控制中心 管理员：<?php echo $_SESSION['admin']; ?> <br><br>
    <a href="/admin/source" target="_blank">源管理</a>
    <a href="/admin/tags" target="_blank">分类管理</a>
    <a href="/admin/article" target="_blank">文章管理</a>
    <a href="/admin/users" target="_blank">用户管理</a>
    <a href="/admin/comments" target="_blank">评论管理</a>
</body>
</html>
