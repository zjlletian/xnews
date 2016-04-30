/**
 * main js by zhoujunlong
 */

//标记侧栏是否打开
var panelopened=false;
$(document).on("opened", ".panel", function() {
    panelopened=true;
});
$(document).on("closed", ".panel", function() {
    panelopened=false;
});

//关闭侧边栏
function closepanel(){
    if(panelopened){
        $.closePanel();
    }
}

//打开左侧栏
function leftpanel(){
    $.openPanel("#userpanel");
}

//打开右侧栏
function rightpanel(){
    $.openPanel("#tagpanel");
}

//打开文章页面
function openarticel(url){
    if(panelopened){
        return false;
    }
    $.router.load(url, true);
}

//打开登陆页面
function openlogin(){
    $.closeModal();
    $.popup('#login');
}

//打开注册页面
function openregist(){
    $.closeModal();
    $.popup('#regist');
}

//ajax加载其他页面开始
$(window).on("pageLoadStart",function() {
    $.showIndicator();
});

//添加收藏
var needfav=0;
function addfavourite(){
    var star=$('#likestar');
    if(localStorage.getItem('userinfo')!=null){
        var user=JSON.parse(localStorage.getItem('userinfo'));
        if(star.attr('data-liked')=='false'){
            $.post('/user/addFav',{uid:user.id, aid:star.attr('data-aid')},function(){
                $.toast('添加收藏成功');
                star.removeClass('fa-star-o').addClass('fa-star');
                star.attr('data-liked','true');
            });
        }
        else{
            $.post('/user/delFav',{uid:user.id, aid:star.attr('data-aid')},function(){
                $.toast('取消收藏成功');
                star.removeClass('fa-star').addClass('fa-star-o');
                star.attr('data-liked','false');
            });
        }
        needfav=0;
    }
    else{
        needfav=star.attr('data-aid');
        $.popup('#login');
        $.toast('收藏前请先登录',500);
    }
}

//用户注册
function regist(){
    $.post('/user/regist', $('#registform').serialize(),function(data){
        if(data.code==1){
            $.post('/user/login', $('#registform').serialize(),function(data){
                if(data.code==1){
                    $.closeModal();
                    localStorage.setItem('userinfo',JSON.stringify(data.user));
                    initUserinfo('注册成功');
                }
            },'json');
        }
        else{
            $.toast(data.msg);
        }
    },'json');
}

//用户登陆
function login(){
    var star=$('#likestar');
    $.post('/user/login', $('#loginform').serialize(),function(data){
        if(data.code==1){
            $.closeModal();
            localStorage.setItem('userinfo',JSON.stringify(data.user));
            initUserinfo('登录成功');
            if(needfav!=0){
                $.post('/user/isFav',{uid:data.user.id, aid:needfav},function(res){
                    if(res==1){
                        star.removeClass('fa-star-o').addClass('fa-star');
                        star.attr('data-liked','true');
                    }
                });
                needfav=0;
            }
        }
        else{
            $.toast(data.msg);
        }
    },'json');
}

//退出登录
function logout(){
    $.confirm('确认注销登录?', function () {
        localStorage.removeItem('userinfo');
        $.post('/user/logout',{},function(){
            initUserinfo('注销登陆成功');
        });
    });
}

//启动应用时自动登录
function autologin(){
    if(localStorage.getItem('userinfo')!=null){
        var user=JSON.parse(localStorage.getItem('userinfo'));
        $.post('/user/login?relogin',{username:user.name,password:user.password},function(data){
            if(data.code==1){
                localStorage.setItem('userinfo',JSON.stringify(data.user));
            }
            else{
                localStorage.removeItem('userinfo');
                $.toast('登录验证失败，请重新登录');
            }
            initUserinfo(false);
        },'json');
    }
}

//初始化用户信息
function initUserinfo(tip){
    if(localStorage.getItem('userinfo')!=null){
        var user=JSON.parse(localStorage.getItem('userinfo'));
        $('#username').html('用户：'+user.name);
        $('.unlogin').css('display','none');
        $('.logined').css('display','');
    }
    else{
        $('.unlogin').css('display','');
        $('.logined').css('display','none');
    }
    if(tip!=false){
        $.toast(tip);
    }
}

var tagid=0;
var tagname='';

//初始化分类列表
function gettaglist(){
    $.get('/index/tags',function(data){
        for(i=0;i<data.length;i++){
            $('#taglist').append("<a onclick='changelist("+data[i].id+",\""+data[i].tagname+"\")' id='tag"+data[i].id+"' class='tag button button-link'>&nbsp;&nbsp;&nbsp;"+data[i].tagname+"</a>");
        }
        changelist(data[0].id,data[0].tagname);
    },'json');
}

//初始化新闻列表
function changelist(id,name){
    $.closePanel();
    tagid=id;
    tagname=name;
    $('#maintitle').html('Xnews - '+name);
    $.showIndicator();
    $.get('/index/newslist?t='+id,function(data){
        $('.tag').removeClass('button-fill');
        $('#tag'+id).addClass('button-fill');
        $('#newslist').html(data);
        $.hideIndicator();
    });
}

//下拉刷新列表
$(document).on('refresh', '.pull-to-refresh-content',function(e) {
    changelist(tagid,tagname);
    $.pullToRefreshDone('.pull-to-refresh-content');
});

//加载收藏列表
function favlist(){
    $.closePanel();
    $.router.load('/user/favlist', true);
}

//提交评论
var template='<div class="card comment"><div class="card-header commentheader"><span class="commentname">{$name}</span><span class="commenttime">发表于{$time} </span>'+
'</div> <div class="card-content"><div class="card-content-inner" class="commenttext">{$text}</div> </div> </div>';

function addcoomment(){
    var star=$('#likestar');
    if(localStorage.getItem('userinfo')!=null){
        var user=JSON.parse(localStorage.getItem('userinfo'));
        comment=$('#comment').val();
        if(comment.length==0){
            $.toast('评论内容不允许为空');
            return false;
        }
        $.post('/user/addComment',{uid:user.id, aid:star.attr('data-aid'), comment:comment},function(time){
            $('#nocomment').css('display','none');
            $('#comment').val('');
            $('#commentlist').append(template.replace('{$name}',user.name).replace('{$time}',time).replace('{$text}',comment));
            $.toast('发表评论成功');
        });
        needfav=0;
    }
    else{
        needfav=star.attr('data-aid');
        $.popup('#login');
        $.toast('评论前请先登录',500);
    }
}

//初始化所有组件
$(function(){
    $.init();
    autologin();
    gettaglist();
});
