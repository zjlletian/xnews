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
        源 地 址 ：<input type='text' name='sourceurl' value="<?php echo $_POST['sourceurl']?>" style='width:500px' id="s"/>
        <br><br>
        链接规则：<input type='text' name='urlrule' value="<?php echo $_POST['urlrule']?>" style='width:500px' id="u"/>
        <br><br>
        <input type="submit" value="分析子链接">&nbsp;<input type="button" value="新浪娱乐示例" onclick="example()">
        <br><hr>
        标题规则：<input type='text'  id='t' name='t' value="<?php echo $_POST['t']?>" style='width:500px'/>
        <br><br>
        正文规则：<input type='text'  id='c' name='c' value="<?php echo $_POST['c']?>" style='width:500px'/>
       <br><br>
        图片规则：<input type='text' id='i' name='i' value="<?php echo $_POST['i']?>" style='width:500px'/>
    </form>
    <br>
    <?php
        if (Request::method()=="POST"){
            foreach (Request::get('urllist') as $url){
                echo "<a onclick='doprevew(\"{$url}\")' href='javascript:void(0)'>{$url}</a><br>";
            }
        }
    ?>
    <form action='/admin/preview' method="post" target="_blank" id='preview'>
        <input type='hidden' name="u" id='uh'>
        <input type='hidden' name="t" id='th'>
        <input type='hidden' name="c" id='ch'>
        <input type='hidden' name="i" id='ih'>
    </form>

    <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        function example(){
            $('#s').val("http://ent.sina.com.cn/");
            $('#u').val("^http://ent.sina.com.cn/(\\w+)/(\\w+)/(\\d{4}-\\d{2}-\\d{2})/doc-(.*)$");
            $('#t').val("#main_title");
            $('#c').val("#artibody p");
            $('#i').val("#artibody .img_wrapper img");
        }

        function doprevew(url){
            $('#uh').val(url);
            $('#th').val($('#t').val());
            $('#ch').val($('#c').val());
            $('#ih').val($('#i').val());
            $('#preview').submit();
        }
    </script>
</body>
</html>
