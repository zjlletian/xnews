<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>

<!doctype html>
<html>
<head>
    <title>Xnews 规则测试</title>
    <?php include(APPROOT.'/public/head.php');?>
</head>

<body>
    <form action="/admin/test" method="post">
        源 地 址 ：<input type='text' name='sourceurl' value="<?php echo $_POST['url']?>" style='width:500px' id="s"/>
        <br><br>
        链接规则：<input type='text' name='urlrule' value="<?php echo $_POST['urlrule']?>" style='width:500px' id="u"/>
        <br><br>
        <input type="submit" value="分析子链接">
        <br><hr>
        标题规则：<input type='text' name='titlerule' value="<?php echo $_POST['titlerule']?>" style='width:500px'  id='t'/>
        <br><br>
        正文规则：<input type='text' name='contentrule' value="<?php echo $_POST['contentrule']?>" style='width:500px'  id='c'/>
       <br><br>
        图片规则：<input type='text' name='imagerule' value="<?php echo $_POST['imagerule']?>" style='width:500px' id='i' />
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
</body>
<script type="text/javascript">
    function doprevew(url){
        $('#uh').val(url);
        $('#th').val($('#t').val());
        $('#ch').val($('#c').val());
        $('#ih').val($('#i').val());
        $('#preview').submit();
    }
</script>
</html>
