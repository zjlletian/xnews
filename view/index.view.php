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
    <div class="page page-current" id="page-index">
        <header class="bar bar-nav">
            <a class="icon icon-me pull-left open-panel" data-panel='#uesrpanel'></a>
            <h1 class="title" id="maintitle">Xnews - 头条</h1>
            <a class="icon icon-menu pull-right open-panel" data-panel='#tagpanel'></a>
        </header>
        <div class="content pull-to-refresh-content" data-ptr-distance="55">
            <div class="pull-to-refresh-layer">
                <div class="preloader">下拉刷新新闻列表</div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div style="margin-bottom: 20px"></div>
            <?php foreach (Request::get('list') as $item):?>
                <a href="/article?id=<?php echo $item['id']?>#articlepage" data-no-cache="true">
                    <?php $images=explode('$$',$item['images']) ?>
                    <div class="card" style="margin-top: -5px; width=100%">
                        <?php if(empty($images[0])):?>
                            <!-- 无图标题 -->
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <div class="newstitle"><?php echo $item['title']?></div>
                                    <div class="titleinfo"><?php echo  $item['alias'].' '.substr(Util::timestr($item['time']),0,16)?>&nbsp;&nbsp;阅读 <?php echo $item['view']?></div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($images[0]) && count($images)<3):?>
                            <!-- 单图片标题 -->
                            <div class="card-content">
                                <div class="card-content-inner" style="height: 90px">
                                    <div style="float:left; width: 65%; height: 100%">
                                        <div class="newstitle"><?php echo $item['title']?></div>
                                        <div class="titleinfo"><?php echo  $item['alias'].' '.substr(Util::timestr($item['time']),0,16)?>&nbsp;&nbsp;阅读 <?php echo $item['view']?></div>
                                    </div>
                                    <div style="float:right; width:32%; text-align:right; height: 100%">
                                        <img src="<?php echo strstr($images[0],'@@')?explode('@@',$images[0])[0]:$images[0]; ?>" style="width: 100%; height: 65px; margin-top: -5px;">
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($images[0]) && count($images)>=3):?>
                            <!-- 三图片标题 -->
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <div class="newstitle"><?php echo $item['title']?></div>
                                    <img src="<?php echo strstr($images[0],'@@')?explode('@@',$images[0])[0]:$images[0]; ?>" style="width: 32%; height: 65px; margin-top: 3px;">
                                    <img src="<?php echo strstr($images[1],'@@')?explode('@@',$images[2])[0]:$images[1]; ?>" style="width: 32%; height: 65px; margin-top: 3px;">
                                    <img src="<?php echo strstr($images[1],'@@')?explode('@@',$images[2])[0]:$images[1]; ?>" style="width: 32%; height: 65px; margin-top: 3px;">
                                    <div class="titleinfo"><?php echo  $item['alias'].' '.substr(Util::timestr($item['time']),0,16)?>&nbsp;&nbsp;阅读 <?php echo $item['view']?></div>
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
<div class="panel panel-left panel-reveal" id="uesrpanel">
    <div class="content-block">
        <p>用户中心 <a class="close-panel">关闭</a></p>
        <p><a class="button button-link" onclick="$.popup('#login')">登录</a> </p>
        <p><a class="button button-link" onclick="$.popup('#regist')">注册</a> </p>
    </div>
</div>

<!-- 分类选择 -->
<div class="panel panel-right panel-reveal" id="tagpanel">
    <div class="content-block">
        <p>分类选择 <a class="close-panel">关闭</a></p>
        <p></p>
    </div>
</div>

<!-- 登录 -->
<div class="popup" id="login">
    <div class="content-block">
        <p>用户登录</p>
        <p><a href="#" class="close-popup">取消</a></p>
    </div>
</div>

<!-- 注册 -->
<div class="popup" id="regist">
    <div class="content-block">
        <p>新用户注册</p>
        <p><a href="#" class="close-popup">取消</a></p>
    </div>
</div>

</body>
<?php include(APPROOT . '/view/template/mscripts.php');?>
<script>
    //ajax加载其他页面
    $(window).on("pageLoadStart",function() {
        $.showIndicator();
    });

    //下拉刷新
    $(document).on('refresh', '.pull-to-refresh-content',function(e) {
        $.showIndicator();
        location.reload();
        $.pullToRefreshDone('.pull-to-refresh-content');
    });

    //添加收藏
    function addfavourite(){
        if(localStorage.getItem('userinfo')!=null){
            var star=$('#likestar');
            if(star.attr('data-liked')=='false'){
                $.toast('添加收藏成功');
                star.removeClass('fa-star-o').addClass('fa-star');
                star.attr('data-liked','true');
            }
            else{
                $.toast('取消收藏成功');
                star.removeClass('fa-star').addClass('fa-star-o');
                star.attr('data-liked','false');
            }
        }
        else{
            $.toast('收藏前请先登录');
            $.popup('#login');
        }
    }

    //初始化
    $(function(){
        $.init();
    });
</script>
</html>
