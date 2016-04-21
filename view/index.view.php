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
            <a class="icon icon-me pull-left open-panel"></a>
            <h1 class="title" id="maintitle">Xnews - 头条</h1>
        </header>
        <div class="content">
            <div class="content-block" id="newslist">
                <a href="/article?id=1">demo</a>
            </div>
        </div>
    </div>

</div>

<div class="panel panel-left panel-reveal">
    <div class="content-block" id="taglist">
        <p>分类选择</p>
        <p></p>
        <!-- Click on link with "close-panel" class will close panel -->
        <p><a class="close-panel">关闭</a></p>
    </div>
</div>
</body>
<script>
    $.init();
</script>
</html>
