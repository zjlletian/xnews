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
    <div class="page page-current" id="page-index" onclick="closepanel()">
        <header class="bar bar-nav">
            <a class="icon icon-me pull-left open-panel" onclick="leftpanel()"></a>
            <h1 class="title" id="maintitle">Xnews - 头条</h1>
            <a class="icon icon-menu pull-right open-panel" onclick="rightpanel()"></a>
        </header>
        <div class="content pull-to-refresh-content" data-ptr-distance="80">
            <div class="pull-to-refresh-layer">
                <div class="preloader">下拉刷新新闻列表</div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div id="newslist" style="margin-top: 12px"></div>
        </div>
    </div>
</div>

<!-- 用户中心 -->
<div class="panel panel-left panel-reveal" id="userpanel">
    <div class="content-block unlogin">
        <p>用户中心</p>
        <p><a class="button button-link" onclick="openlogin()">登录</a> </p>
        <p><a class="button button-link" onclick="openregist()">注册</a> </p>
    </div>
    <div class="content-block logined" style="display: none">
        <p>用户中心</p>
        <p id="username">用户名：xxx</p>
        <p><a class="button button-link" onclick="favlist()">收藏列表</a> </p>
        <p><a class="button button-link" onclick="logout()">退出登录</a> </p>
    </div>
</div>

<!-- 分类选择 -->
<div class="panel panel-right panel-reveal" id="tagpanel">
    <div class="content-block">
        <p>&nbsp;&nbsp;&nbsp;分类选择</p>
        <div id="taglist"></div>
    </div>
</div>

<!-- 登录 -->
<div class="popup" id="login">
    <div class="content-block">
        <div style="width: 100%; padding-left: 10%">
            <h2>xnews - 用户登录</h2>
        </div>
        <div class="list-block">
            <form id="loginform">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-name"></i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="text" placeholder="用户名" name="username">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-password"></i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="password" placeholder="密码" name="password">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <div class="content-block">
            <div class="row">
                <div class="col-100">
                    <a class="button" onclick="login()">登录</a>
                    <br>
                    <a class="button button-danger close-popup">取消</a>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-100" style="text-align: center"><a  href="javascript:openregist()">没有账户？ 注册一个吧</a></div>
            </div>
        </div>
    </div>
</div>

<!-- 注册 -->
<div class="popup" id="regist">
    <div class="content-block">
        <div style="width: 100%; padding-left: 10%">
            <h2>xnews - 新用户注册</h2>
        </div>
        <div class="list-block">
            <form id="registform">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-name"></i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="text" placeholder="用户名" name="username">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-email"></i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="email" placeholder="常用邮箱" name="email">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-password"></i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="password" placeholder="密码" name="password">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-password"></i></div>
                            <div class="item-inner">
                                <div class="item-input">
                                    <input type="password" placeholder="确认密码" name="password2">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <div class="content-block">
            <div class="row">
                <div class="col-100">
                    <a class="button" onclick="regist()">注册</a>
                    <br>
                    <a class="button button-danger close-popup">取消</a>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-100" style="text-align: center"><a href="javascript:openlogin()">已有账户？ 赶快登录吧</a></div>
            </div>
        </div>
    </div>
</div>

</body>
<?php include(APPROOT . '/view/template/mscripts.php');?>
</html>
