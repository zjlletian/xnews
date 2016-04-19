<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin/">Xnews管理中心</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-user"></span>&nbsp;&nbsp;<?php echo $_SESSION['admin']['name']?>&nbsp;&nbsp;<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/adminpasswd"><span class="fa fa-edit"></span>&nbsp;&nbsp;&nbsp;修改密码</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/admin/logout"><span class="fa fa-power-off"></span>&nbsp;&nbsp;&nbsp;退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
