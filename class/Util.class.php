<?php
require_once(dirname(dirname(__FILE__)).'/autoload.php');

class Util{
	//字符串startwith
	static function strStartWith($str, $needle){
		return strpos($str, $needle) === 0;
	}

	//字符串endwith
	static function strEndWith($str, $needle){
		$length = strlen($needle);  
		if($length == 0) {    
			return true;  
		}  
		return (substr($str, -$length) === $needle);
	}

	//时间格式化
	static function timestr($time=null){
		if($time!=null){
			return date("Y-m-d H:i:s",$time);
		}
		else{
			return date("Y-m-d H:i:s");
		}
	}
}
