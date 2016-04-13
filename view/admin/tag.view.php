<?php
    require_once(dirname(dirname(dirname(__FILE__))) . '/autoload.php');
?>
<!doctype html>

<head>
    <title>Xnews源管理</title>
    <?php include(APPROOT . '/view/template/head.php');?>
</head>

<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:400px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加分类</h4>
            </div>
            <div class="modal-body">
                <form id="mainform" method="post" target="_blank" action="/admin/test">
                        <input type='hidden' name='sid' id="sid"/>
                        <label class="formlabel">分类名称</label>
                        <input type='text' id='tagname' name='tagname' class="form-control input-sm" placeholder="分类名称，如新浪娱乐"/>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" onclick="additem()" id="btn_add">添加</button>
                <button class="btn btn-sm btn-success" onclick="moditem()" id="btn_mod" style="display:none">修改</button>&nbsp;&nbsp;
                <button class="btn btn-sm btn-warning" data-dismiss="modal" aria-label="Close">取消</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:400px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tagtitle">源列表</h4>
            </div>
            <div class="modal-body">
                <div id="sourcelist"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">确定</button>
            </div>
        </div>
    </div>
</div>

<?php include(APPROOT . '/view/template/adminnav.php');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/source/">源链管理</a></li>
                <li class="active"><a href="/tag/">分类管理</a></li>
                <li><a href="/article/">文章管理</a></li>
                <li><a href="/userinfo/">用户管理</a></li>
                <li><a href="/comments/">评论管理</a></li>
            </ul>
        </div>
        <div class="col-md-6">
            <h3 style="display:inline;">分类列表</h3>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal" style="margin-top:-8px">添加分类</button>
            <br><br>
            <table class="table table-responsive table-bordered">
                <tr><th>分类名称</th><th>查看源列表</th><th>修改分类名称</th><th>删除</th></tr>
                <?php foreach (Request::get('list') as $item):?>
                    <tr>
                        <td><?php echo $item['tagname']?></td>
                        <td>
                            <a href="javascript:showlist(<?php echo $item['id'].",'".$item['tagname']."'"?>)" class="btn btn-xs btn-info">
                                &nbsp;&nbsp;查看&nbsp;&nbsp;<span class="badge"><?php echo $item['sourcecount']?></span>&nbsp;
                            </a>
                        </td>
                        <td><a href="javascript:showinfo(<?php echo $item['id'].",'".$item['tagname']."'"?>)" class="btn btn-xs btn-warning">&nbsp;&nbsp;修改&nbsp;&nbsp;</a></td>
                        <td><a href="javascript:delitem(<?php echo $item['id']?>)" class="btn btn-xs btn-danger">&nbsp;&nbsp;删 除&nbsp;&nbsp;</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(function(){
        $('#myModal').on('hidden.bs.modal', function() {
            $('#mainform')[0].reset();
            $('#btn_add').css('display','');
            $('#btn_mod').css('display','none');
            $('#myModalLabel').html('添加分类');
        })
    });

    //添加源
    function additem(){
        $.post("/tag/add", $('#ruleform').serialize(), function(data){
            if(data.status!=1){
                alert(data.msg);
            }
            else{
                alert('添加成功');
                location.reload();
            }
        });
    }

    //显示详情
    function showinfo(id,value){
        $('#sid').val(id);
        $('#tagname').val(value);
        $('#btn_add').css('display','none');
        $('#btn_mod').css('display','');
        $('#myModalLabel').html('修改分类名称');
        $('#myModal').modal('show');
    }

    //显示分类下的源列表
    function showlist(id,value){
        $('#tagtitle').html("源列表 "+value);
        $('#sourcelist').html('');
        $.get('/tag/tagsource?id='+id,function(data){
            if(data.length>0){
                for(i=0;i<data.length;i++){
                    $('#sourcelist').append(data[i].alias+'</br>');
                }
            }
            else{
                $('#sourcelist').html('该分类中不包含源');
            }
            $('#infoModal').modal('show');
        });
    }

    //修改源
    function moditem(){
        $.post("/tag/modify", $('#mainform').serialize(), function(data){
            if(data.status!=1){
                alert(data.msg);
            }
            else{
                alert('修改成功');
                location.reload();
            }
        });
    }

    //删除源
    function delitem(id){
        $.post("/tag/del",{sid:id}, function(data){
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
