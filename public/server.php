<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

//获取访问路径
if(!isset($_GET['_querypath'])) {
    http_response_code(403);
    die("can't request server.php directly, valid request path example : /controller/method?args=xxx");
}
$querypath = $_GET['_querypath'];
unset($_GET['_querypath']);

//获取controller与method
if( preg_match_all('/(.*)\/(.*)/', $querypath, $cm) == 1 ) {
    $controller=$cm[1][0];
    $method=$cm[2][0];
}
else{
    $controller=$querypath;
    $method = '';
}
//检查controller与method格式
if(strpos($controller,'/' )!==false || strpos($method,'/' )!==false || strpos($controller,' ' )!==false || strpos( $method,' ' )!==false){
    http_response_code(400);
    die("can't parse path: ".$querypath);
}
//controller首字自动转大写，类文件名：Xxxx.action.php ,类名：XxxxController
$controller = empty($controller)? 'Index' : ucfirst($controller);
//method
$method = empty($method)? 'index' : $method;

//加载controller文件
$actionfile=APPROOT.'/action/'.$controller.'.action.php';
if(file_exists($actionfile)) {
    require_once($actionfile);
}
else{
    http_response_code(404);
    die('controller file not exist: '.$actionfile);
}

//检查并执行controller->method()
$instance=$controller.'Controller';
if(! class_exists($instance)){
    http_response_code(400);
    die('controller class not exist: '.$instance);
}
if(! is_callable(array($instance, $method))){
    http_response_code(400);
    die('controller method not exist: '.$instance.'->'.$method.'()');
}
session_start();
$instance = new $instance();
$instance->$method();
