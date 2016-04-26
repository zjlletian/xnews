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
            <div style="margin-bottom: 12px"></div>
            <?php foreach (Request::get('list') as $item):?>
                <a onclick="openarticel('/article?id=<?php echo $item['id']?>')">
                    <?php $images=explode('$$',$item['images']) ?>
                    <div class="card" style="margin-top: -6px; width=100%">
                        <?php if(empty($images[0])):?>
                            <!-- 无图标题 -->
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <div class="newstitle"><?php echo $item['title']?></div>
                                    <div class="titleinfo"><?php echo  $item['alias'].' · '.substr(Util::timestr($item['time']),0,16)?> · 阅读 <?php echo $item['view']?></div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($images[0]) && count($images)<3):?>
                            <!-- 单图片标题 -->
                            <div class="card-content">
                                <div class="card-content-inner" style="height: 90px">
                                    <div style="float:left; width: 65%; height: 100%">
                                        <div class="newstitle"><?php echo $item['title']?></div>
                                        <div class="titleinfo"><?php echo  $item['alias'].' · '.substr(Util::timestr($item['time']),0,16)?> · 阅读 <?php echo $item['view']?></div>
                                    </div>
                                    <div style="float:left; width:32%; height: 65px; margin-left: 2%; text-align: center;">
                                        <img src="<?php echo strstr($images[0],'@@')?explode('@@',$images[0])[0]:$images[0]; ?>" style="width: 100%; height: 100%">
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($images[0]) && count($images)>=3):?>
                            <!-- 三图片标题 -->
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <div class="newstitle"><?php echo $item['title']?></div>
                                    <img src="<?php echo strstr($images[0],'@@')?explode('@@',$images[0])[0]:$images[0]; ?>" style="width: 32%; height: 65px; ">
                                    <img src="<?php echo strstr($images[1],'@@')?explode('@@',$images[2])[0]:$images[1]; ?>" style="width: 32%; height: 65px; ">
                                    <img src="<?php echo strstr($images[1],'@@')?explode('@@',$images[2])[0]:$images[1]; ?>" style="width: 32%; height: 65px; ">
                                    <div class="titleinfo"><?php echo  $item['alias'].' · '.substr(Util::timestr($item['time']),0,16)?> · 阅读 <?php echo $item['view']?></div>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 用户中心 -->
<div class="panel panel-left panel-reveal" id="loginpanel">
    <div class="content-block">
        <p>用户中心</p>
        <p><a class="button button-link" onclick="openlogin()">登录</a> </p>
        <p><a class="button button-link" onclick="openregist()">注册</a> </p>
    </div>
</div>

<div class="panel panel-left panel-reveal" id="userpanel">
    <div class="content-block">
        <p>用户中心</p>
        <p>用户名：xxx</p>
        <p><a class="button button-link">注销</a> </p>
    </div>
</div>

<!-- 分类选择 -->
<div class="panel panel-right panel-reveal" id="tagpanel">
    <div class="content-block">
        <p>分类选择</p>
        <p></p>
    </div>
</div>

<!-- 登录 -->
<div class="popup" id="login">
    <div class="content-block">
        <div style="width: 100%; padding-left: 10%">
            xnews - 用户登录
        </div>
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="用户名或邮箱">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-password"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="password" placeholder="密码">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="content-block">
            <div class="row">
                <div class="col-50"><a class="button button-fill button-success">登录</a></div>
                <div class="col-50"><a class="button button-fill button-danger close-popup">取消</a></div>
            </div>
            <div class="row">
                <br>
                <div class="col-100" style="text-align: center"><a  href="javascript:openregist()">没有账户？ 注册一个吧</a></div>
            </div>
        </div>
    </div>
</div>

<!-- 注册 -->
<div class="popup" id="regist">
    <div class="content-block">
        <div style="width: 100%; padding-left: 10%">
            xnews - 新用户注册
        </div>
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="用户名">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-email"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="email" placeholder="常用邮箱">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-password"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="password" placeholder="密码">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-password"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="password" placeholder="确认密码">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="content-block">
            <div class="row">
                <div class="col-50"><a class="button button-fill button-success">提交</a></div>
                <div class="col-50"><a class="button button-fill button-danger close-popup">取消</a></div>
            </div>
            <div class="row">
                <br>
                <div class="col-100" style="text-align: center"><a href="javascript:openlogin()">已有账户？ 赶快登录吧</a></div>
            </div>
        </div>
    </div>
</div>

</body>
<?php include(APPROOT . '/view/template/mscripts.php');?>
</html>
