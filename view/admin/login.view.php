<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>

<!doctype html>
<html>
<head>
    <title>Xnews 管理员登陆</title>
    <meta charset="utf-8">
</head>

<body>
    <form action="/admin/login" method="post">
        <input type="text" name="name" placeholder="用户名" value="<?php echo $_POST['name']?>">
        <input type="password" name="password" placeholder="密码" value="<?php echo $_POST['password']?>">
        <input type="submit" value="登录">
        <?php echo Request::get('msg'); ?>
    </form>
</body>
</html>
