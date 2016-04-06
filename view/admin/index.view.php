<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>

<!doctype html>
<html>
<head>
    <title>Xnews 管理中心</title>
    <?php include(APPROOT . '/view/template/head.php');?>
</head>

<body>
<?php include(APPROOT . '/view/template/adminnav.php');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="/source/">源链管理</a></li>
                <li><a href="/tag/">分类管理</a></li>
                <li><a href="/article/">文章管理</a></li>
                <li><a href="/userinfo/">用户管理</a></li>
                <li><a href="/comments/">评论管理</a></li>
            </ul>
        </div>
        <div class="col-md-10"></div>
    </div>
</div>
</body>
</html>
