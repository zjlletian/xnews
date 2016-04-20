<nav style="margin-top: -20px">
    <ul class="pagination pagination-sm">
        <?php
        $pageurl=Request::get('pageurl');
        $pages=Request::get('pages');
        $page=Request::get('page');
        $from=1;
        $to=$pages;
        if($page>7){
            $from=$page-7;
        }
        if($pages-$page>7){
            $to=$page+7;
        }
        $from=$to-14>0?$to-14:1;
        $to=$from+14>$pages?$pages:$from+14;
        ?>

        <!-- 上一页 -->
        <?php if($page!=1): ?>
            <li><a href="<?php echo  $pageurl.'1'?>">首页</a></li>
            <li ><a href="<?php echo  $pageurl.($page-1)?>"><span>&laquo;</span></a></li>
        <?php endif;?>
        <?php if($page==1): ?>
            <li class="disabled"><a>首页</a></li>
            <li class="disabled"><span>&laquo;</span></li>
        <?php endif;?>

        <!-- 所有分页，最多显示15个分页数目 -->
        <?php for($i=$from;$i<=$to;$i++): ?>
            <li <?php if($i== $page) echo "class='active'"; ?>><a href="<?php echo  $pageurl.$i ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>

        <!-- 下一页 -->
        <?php if($page!= $pages && $pages>0): ?>
            <li><a href="<?php echo  $pageurl.($page+1)?>"><span>&raquo;</span></a></li>
            <li><a href="<?php echo  $pageurl.$pages?>">尾页</a></li>
        <?php endif;?>
        <?php if($page==$pages || $pages==0): ?>
            <li class="disabled"><span>&raquo;</span></li>
            <li class="disabled"><a>尾页</a></li>
        <?php endif;?>
    </ul>
</nav>
