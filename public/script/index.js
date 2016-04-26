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

//ajax加载其他页面完成
$(window).on("pageLoadComplete",function() {
    //$.router.load("#articlepage");
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

//注册
function regist(){
    $.post('/user/regist', $('#registform').serialize(),function(data){
        if(data.code==1){
            $.post('/user/login', $('#registform').serialize(),function(data){
                if(data.code==1){
                    $.closeModal();
                    localStorage.setItem('userinfo',JSON.stringify(data.user));
                    initlogin('注册成功');
                }
            },'json');
        }
        else{
            $.toast(data.msg);
        }
    },'json');
}

//登陆
function login(){
    $.post('/user/login', $('#loginform').serialize(),function(data){
        if(data.code==1){
            $.closeModal();
            localStorage.setItem('userinfo',JSON.stringify(data.user));
            initlogin('登录成功');
        }
        else{
            $.toast(data.msg);
        }
    },'json');
}

//初始化登陆
function initlogin(tip){
    if(localStorage.getItem('userinfo')!=null){
        var user=JSON.parse(localStorage.getItem('userinfo'));
        $('#username').html('用户：'+user.name);
        $('.unlogin').css('display','none');
        $('.logined').css('display','');
        if(tip!=false){
            $.toast(tip);
        }
    }
    else{
        $('.unlogin').css('display','');
        $('.logined').css('display','none');
    }
}

//退出登录
function outlogin(){
    $.confirm('确认注销登录?', function () {
        localStorage.removeItem('userinfo');
        $('.unlogin').css('display','');
        $('.logined').css('display','none');
    });
}

//初始化所有组件
$(function(){
    $.init();
    initlogin(false);
});
