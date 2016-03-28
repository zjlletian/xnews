<?php
define('APPROOT',dirname(__FILE__));

//包涵核心文件
require_once(APPROOT . '/core/DB.php');
require_once(APPROOT . '/core/Model.php');
require_once(APPROOT . '/core/Request.php');
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
