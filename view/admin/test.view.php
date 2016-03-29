<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>

<!doctype html>
<html>
<head>
    <title>Xnews</title>
    <meta charset="utf-8">
</head>

<body>
    <form action="/admin/test" method="post">
        源 地 址 ：<input type='text' name='sourceurl' value="<?php echo $_POST['sourceurl']?>" style='width:500px'/>
        新浪娱乐示例：http://ent.sina.com.cn/<br><br>
        链接规则：<input type='text' name='urlrule' value="<?php echo $_POST['urlrule']?>" style='width:500px'/>
         ^http://ent.sina.com.cn/(\w+)/(\w+)/(\d{4}-\d{2}-\d{2})/doc-(.*)$<br><br>
        标题规则：<input type='text' name='titlerule' value="<?php echo $_POST['titlerule']?>" style='width:500px'/>
         #main_title<br><br>
        正文规则：<input type='text' name='contentrule' value="<?php echo $_POST['contentrule']?>" style='width:500px'/>
         #artibody p<br><br>
        标题规则：<input type='text' name='imgrule' value="<?php echo $_POST['imgrule']?>" style='width:500px'/>
         #artibody .img_wrapper img<br><br>
        <input type="submit" value='生成规则预览'><br><br>
    </form>

    <?php
        $t=str_replace("#","〇",$_POST['titlerule']);
        $c=str_replace("#","〇",$_POST['contentrule']);
        $i=str_replace("#","〇",$_POST['imgrule']);
        if (Request::method()=="POST"){
            foreach (Request::get('urllist') as $url){
                echo "<a href='{$url}' target='_blank'>原网页</a> <a href='/admin/preview?u={$url}&t={$t}&c={$c}&i={$i}' target='_blank'>{$url}</a><br>";
            }
        }
    ?>
</body>
</html>
