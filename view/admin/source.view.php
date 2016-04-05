<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
    $list=Request::get('list');
?>

<!doctype html>
<html>
<head>
    <title>Xnews源管理</title>
    <meta charset="utf-8">
</head>

<body>
    <table>
        <tr><th>标识</th><th>源地址</th><th>分类</th><th>添加时间</th><th>最后采集时间</th><th>详情</th><th>删除</th></tr>
        <?php foreach ($list as $item):?>
            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
