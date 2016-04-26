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
    if (localStorage.getItem('userinfo') != null) {
        $.openPanel("#userpanel");
    }
    else {
        $.openPanel("#loginpanel");
    }
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

//初始化登陆
function initlogin(){
    if(localStorage.getItem('userinfo')!=null){

    }
}

//初始化所有组件
$(function(){
    $.init();
    initlogin();
});