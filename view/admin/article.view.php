<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>
<!doctype html>

<head>
    <title>Xnews 管理中心</title>
    <?php include(APPROOT . '/view/template/head.php');?>
</head>

<body>
<?php include(APPROOT . '/view/template/adminnav.php');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/source/">源链管理</a></li>
                <li><a href="/tag/">分类管理</a></li>
                <li  class="active"><a href="/article/">文章管理</a></li>
                <li><a href="/userinfo/">用户管理</a></li>
                <li><a href="/comments/">评论管理</a></li>
            </ul>
        </div>
        <div class="col-md-7">
            <form class="form-inline">
                <h3 style="display:inline;">文章列表</h3>&nbsp;&nbsp;&nbsp;
                <select class="form-control input-sm"  id="source" style="margin-top:-8px">
                    <option value="0" <?php if(!isset($_GET['s'])){ echo 'selected'; }?>> 所有来源 </option>
                    <?php foreach (Request::get('source') as $item): ?>
                        <option value='<?php echo $item['id'];?>' <?php if(isset($_GET['s']) && $_GET['s']==$item['id']){ echo 'selected'; }?>><?php echo $item['alias'];?></option>;
                    <?php endforeach;?>
                </select>
                <button type="button" class="btn btn-sm btn-success" style="margin-top:-8px" onclick="changesource()">筛选</button>
            </form>
            <br>
            共 <span style="color:#5bc0de"><?php echo Request::get('total')?></span> 条记录，<span style="color:#5bc0de"><?php echo Request::get('pages')?></span> 页，
            当前第 <span style="color:#5bc0de"><?php echo Request::get('page')?></span> 页
            <br><br>
            <table class="table table-responsive table-bordered">
                <tr><th>标题</th><th>来源</th><th>分类</th><th>添加时间</th><th>删除文章</th></tr>
                <?php foreach (Request::get('list') as $item):?>
                    <tr>
                        <td><a href="/article?id=<?php echo $item['id']?>&pre" target="_blank"><?php echo $item['title']?></a></td>
                        <td><?php echo $item['alias']?></td>
                        <td><?php echo $item['tagname']?></td>
                        <td><?php echo Util::timestr($item['time'])?></td>
                        <td><a href="javascript:delitem(<?php echo $item['id']?>)" class="btn btn-xs btn-danger">&nbsp;&nbsp;删 除&nbsp;&nbsp;</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div style="text-align: center">
                <?php include(APPROOT . '/view/template/pageer.php');?>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">

    //选择来源
    function changesource(){
        $sourceid=$('#source').val();
        if($sourceid=='0'){
            window.location.href='/article/?p=1';
        }
        else{
            window.location.href='/article/?s='+$sourceid+'&p=1';
        }
    }

    //删除
    function delitem(id){
        $.post("/article/del",{sid:id}, function(data){
            if(data.status!=1){
                alert(data.msg);
            }
            else{
                alert('删除成功');
                location.reload();
            }
        });
    }
</script>
