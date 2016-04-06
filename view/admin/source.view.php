<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>
<!doctype html>

<head>
    <title>Xnews源管理</title>
    <?php include(APPROOT.'/public/head.php');?>
</head>

<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:400px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">添加源规则</h4>
            </div>
            <div class="modal-body">
                <form id="ruleform" method="post" target="_blank" action="/admin/test">
                        <input type='hidden' name='sid'/>
                        <label class="formlabel">源链标题</label><input type='text' id='alias' name='alias' class="form-control input-sm"/>
                        <label class="formlabel">源链地址</label><input type='text' id='url' name='url' class="form-control input-sm"/>
                        <label class="formlabel">子链正则</label><input type='text' id='urlrule' name='urlrule' class="form-control input-sm"/>
                        <label class="formlabel">标题规则</label><input type='text'  id='titlerule' name='titlerule' class="form-control input-sm"/>
                        <label class="formlabel">正文规则</label><input type='text'  id='contentrule' name='contentrule' class="form-control input-sm"/>
                        <label class="formlabel">图片规则</label><input type='text' id='imagerule' name='imagerule' class="form-control input-sm"/>
                        <label class="formlabel">所属分类</label>
                        <select class="form-control input-sm"  id="tag" name="tag">
                            <?php
                            foreach (Request::get('tags') as $tag){
                                echo "<option value='{$tag['id']}'>{$tag['tagname']}</option>";
                            }
                            ?>
                        </select>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-info" onclick="$('#ruleform').submit()">测试规则</button>&nbsp;&nbsp;
                <button class="btn btn-sm btn-success" onclick="addsource()" id="btn_add">添加</button>
                <button class="btn btn-sm btn-success" onclick="modsource()" id="btn_mod" style="display:none">修改</button>&nbsp;&nbsp;
                <button class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">取消</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="list" class="'row">
        <div class="col-md-12">
            <h3 style="display:inline;">源列表</h3>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">添加源</button>
            <table class="table">
                <tr><th>标识</th><th>源地址</th><th>分类</th><th>添加时间</th><th>最后采集时间</th><th>操作</th></tr>
                <?php foreach (Request::get('list') as $item):?>
                    <tr>
                        <td><?php echo $item['alias']?></td>
                        <td><a href="<?php echo $item['url']?>" target="_blank"><?php echo $item['url']?></a></td>
                        <td><?php echo $item['tagname']?></td>
                        <td><?php echo $item['addtime']?></td>
                        <td><?php echo $item['updatetime']==0?'未采集':Util::timestr($item['updatetime']);?></td>
                        <td>
                            <a href="javascript:showinfo(<?php echo $item['id']?>)">详情</a>
                            <a href="/admin/test?sid=<?php echo $item['id']?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(function(){
        $('#myModal').on('hidden.bs.modal', function (e) {
            $('#ruleform')[0].reset();
            $('#btn_add').css('display','');
            $('#btn_mod').css('display','none');
            $('#myModalLabel').html('添加源规则');
        })
    });

    //添加源
    function addsource(){
        $.post("/source/add", $('#ruleform').serialize(), function(data){
            if(data.status!=1){
                alert(data.msg);
            }
            else{
                location.reload();
            }
        });
    }

    //显示详情
    function showinfo(id){
        $.get('/source/get?sid='+id,function(data){

            $('#alias').val(data.alias);
            $('#url').val(data.url);
            $('#urlrule').val(data.urlrule);
            $('#titlerule').val(data.titlerule);
            $('#contentrule').val(data.contentrule);
            $('#imagerule').val(data.imagerule);
            $('#tag').val(data.tag_id);
            $('#btn_add').css('display','none');
            $('#btn_mod').css('display','');
            $('#myModalLabel').html('修改源规则');
            $('#myModal').modal('show');
        });
    }

    //修改源
    function modsource(){
        $.post("/source/modify", $('#ruleform').serialize(), function(data){
            if(data.status!=1){
                alert(data.msg);
            }
            else{
                location.reload();
            }
        });
    }
</script>
