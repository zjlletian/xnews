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
        <div class="content">
            <div style="margin-bottom: 10px"></div>
            <?php foreach (Request::get('list') as $item):?>
                <a href="/article?id=<?php echo $item['id']?>" data-no-cache="true">
                    <?php $images=explode('$$',$item['images']) ?>
                    <div class="card" style="margin-top: -5px; width=100%">
                        <?php if(empty($images[0])):?>
                            <!-- 无图标题 -->
                            <div class="card-content">
                                <div class="card-content-inner"><?php echo $item['title']?></div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($images[0]) && count($images)<3):?>
                            <!-- 单图片标题 -->
                            <div class="card-content">
                                <div class="card-content-inner" style="height: 90px">
                                    <div style="float:left; width: 70%; height: 100%">
                                        <?php echo $item['title']?>
                                    </div>
                                    <div style="float:right; width:25%; text-align:right; height: 100%">
                                        <img src="<?php echo strstr($images[0],'@@')?explode('@@',$images[0])[0]:$images[0]; ?>" style="width: 100%; height: 75px; margin-top: -10px;">
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($images[0]) && count($images)>=3):?>
                            <!-- 三图片标题 -->
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <?php echo $item['title']?><br>
                                    <img src="<?php echo strstr($images[0],'@@')?explode('@@',$images[0])[0]:$images[0]; ?>" style="width: 32%; height: 90px; margin-top: 3px;">
                                    <img src="<?php echo strstr($images[1],'@@')?explode('@@',$images[2])[0]:$images[1]; ?>" style="width: 32%; height: 90px; margin-top: 3px;">
                                    <img src="<?php echo strstr($images[1],'@@')?explode('@@',$images[2])[0]:$images[1]; ?>" style="width: 32%; height: 90px; margin-top: 3px;">
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
        <p>用户中心</p>
        <p></p>
        <p><a class="close-panel">关闭</a></p>
    </div>
</div>

<!-- 分类选择 -->
<div class="panel panel-right panel-reveal" id="tagpanel">
    <div class="content-block">
        <p>分类选择</p>
        <p></p>
        <p><a class="close-panel">关闭</a></p>
    </div>
</div>

</body>
<?php include(APPROOT . '/view/template/mscripts.php');?>
<script>
    //ajax加载其他页面
    $(window).on("pageLoadStart",function() {
        $.showIndicator();
    });

    //加载文章页面完成
    $(window).on("pageLoadComplete",function() {
        if($('#pagename').val()=='article'){

        }
    });

    //添加收藏
    function addfavourite(){
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

    //初始化
    $(function(){
        $.init();
    });
</script>
</html>
