<?php
    require_once(dirname(dirname(__FILE__)) . '/autoload.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Xnews</title>
    <?php include(APPROOT . '/view/template/mhead.php');?>
</head>

<body>
<!-- 所有Page -->
<div class="page-group">
    <!-- 首页page -->
    <div class="page page-current">
        <header class="bar bar-nav">
            <a class="icon icon-me open-panel pull-left" data-panel='#uesrpanel'></a>
            <h1 class="title" id="maintitle">Xnews - 头条</h1>
            <a class="icon icon-me open-panel pull-right" data-panel='#tagpanel'></a>
        </header>
        <div class="content">
            <div class="content-block" id="newslist">
                <a href="/article?id=1">demo</a>
            </div>
        </div>
    </div>
</div>

<!-- 用户中心 -->
<div class="panel panel-left panel-reveal" id="uesrpanel">
    <div class="content-block">
        <p>用户中心</p>
        <p></p>
        <p><a class="close-panel">关闭</a></p>
    </div>
</div>

<!-- 分类选择 -->
<div class="panel panel-right panel-reveal" id="tagpanel">
    <div class="content-block">
        <p>分类选择</p>
        <p></p>
        <p><a class="close-panel">关闭</a></p>
    </div>
</div>
</body>
<script>
    $.init();
</script>
</html>
