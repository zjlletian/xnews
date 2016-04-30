<?php
    require_once(dirname(dirname(__FILE__)) . '/autoload.php');
?>

<?php foreach (Request::get('list') as $item):?>
    <a onclick="openarticel('/article?id=<?php echo $item['id']?>')">
        <?php $images=explode('$$',ltrim($item['images']),'#@#@#') ?>
        <div class="card" style="margin-top: -6px; width=100%">
            <?php if(empty($images[0])):?>
                <!-- 无图标题 -->
                <div class="card-content">
                    <div class="card-content-inner">
                        <div class="newstitle"><?php echo $item['title']?></div>
                        <div class="titleinfo"><?php echo  $item['alias'].' '.substr(Util::timestr($item['time']),0,16)?> · 阅读 <?php echo $item['view']?></div>
                    </div>
                </div>
            <?php endif;?>

            <?php if(!empty($images[0]) && count($images)<3):?>
                <!-- 单图片标题 -->
                <div class="card-content">
                    <div class="card-content-inner" style="height: 90px">
                        <div style="float:left; width: 65%; height: 100%">
                            <div class="newstitle"><?php echo $item['title']?></div>
                            <div class="titleinfo"><?php echo  $item['alias'].' '.substr(Util::timestr($item['time']),0,16)?> · 阅读 <?php echo $item['view']?></div>
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
                        <div class="titleinfo"><?php echo  $item['alias'].' '.substr(Util::timestr($item['time']),0,16)?> · 阅读 <?php echo $item['view']?></div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </a>
<?php endforeach; ?>

