<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');
?>

<div class="page-group">
    <div class="page" id='articlepage'>
        <input type="hidden" id="articleid" value="<?php echo $article['id']?>">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left back"></span></a>
            <h1 class="title" id="maintitle">Xnews - 收藏列表</h1>
        </header>
        <div class="content" style="background-color:white;">
            <div id="newslist" style="margin-top: 12px">
                <?php foreach (Request::get('list') as $item):?>
                    <a onclick="openarticel('/article?id=<?php echo $item['id']?>')">
                        <div class="card" style="margin-top: -6px; width=100%; border: 1px solid #eee;">
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <div class="newstitle"><?php echo $item['title']?></div>
                                    <div class="titleinfo">收藏时间： <?php echo substr(Util::timestr($item['favtime']),0,16)?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
