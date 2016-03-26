<?php
define('APPROOT',dirname(__FILE__));

//设置include包含文件所在的所有目录
$include_path=get_include_path();
$include_path.=PATH_SEPARATOR.APPROOT."/lib";
set_include_path($include_path);

//包涵核心文件
require_once(APPROOT . '/core/DB.php');
require_once(APPROOT . '/core/View.php');
require_once(APPROOT . '/core/Controller.php');

//包涵model文件
foreach(new FilesystemIterator(APPROOT."/model", FilesystemIterator::SKIP_DOTS ) as $classfile) {
    require_once($classfile);
}
//包涵自定义类文件
foreach(new FilesystemIterator(APPROOT."/class", FilesystemIterator::SKIP_DOTS ) as $classfile) {
    require_once($classfile);
}

//包含配置文件
include_once(APPROOT . '/config.inc.php');
